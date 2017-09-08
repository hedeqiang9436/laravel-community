<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegister;
use App\Mail\OrderShipped;
use App\User;
use function GuzzleHttp\Promise\all;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;
use Intervention\Image\Facades\Image;
/**
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
    public function register()
    {
        return view('users.register');
    }

    public function store(UserRegister $request)
    {
        //dd($request->all());
        $data=[
            'confirm_code'=>str_random(48),
            'avatar'=>'/images/laravelCode.png'
        ];
        $user= User::create(array_merge($request->all(),$data));
        $subject='确认注册LaravelCode';
        $view='email.register';
        $request->session()->flash('status', '邮件发送成功');
        $this->sendTo($user,$subject,$view,$data['confirm_code']);
        return redirect('/index');
    }

    public function sendTo($user,$subject,$view,$data=[])
    {
        Mail::to($user)
            ->send(new OrderShipped($data));
    }

    public function confirmEmail($confirm_code)
    {
        $user=User::where('confirm_code',$confirm_code)->first();
        if (is_null($user))
        {
            return redirect('/index');
        }
        $user->is_confirmed=1;
        $user->confirm_code=str_random(48);
        $user->save();

        return redirect('/user/login');
    }

    public function login()
    {
        return view('users.login');
    }

    public function signin(UserLoginRequest $request)
    {
        $email=$request->input('email');
        $password=$request->input('password');

        if (Auth::attempt([
            'email'=>$email,
            'password'=>$password,
            'is_confirmed'=>1
        ])){
            return redirect('/index');
        }
        //$user= User::where('email',$email)->where('password',$password)->first();
        Session::flash('user_login_failed','用户名或密码不正确');
        return redirect('/user/login')->withInput();
    }

    public function logout()
    {
         Auth::logout();
         return redirect('/index');
    }

    /*
     * 更换头像
     */
    public function avatar()
    {
        return view('users.avatar');
    }
    public function changeAvatar(Request $request)
    {
        $file=$request->file('avatar');
        $input=array('image'=>$file);
        $rules=array(
            'image'=>'image'
        );
        $validator=\Validator::make($input,$rules);
        if ($validator->fails())
        {
            return \Response::json([
                'success'=>false,
                'errors'=>$validator->getMessageBag()->toArray()
            ]);
        }



        $destinationPath='uploads/';
        $fileName=Auth::user()->id.'_'.time(). $file->getClientOriginalName();

        $file->move($destinationPath,$fileName);

        Image::make($destinationPath.$fileName)->fit(400)->save();

//        $user=User::find(Auth::user()->id);
//        $user->avatar='/'.$destinationPath.$fileName;
//        $user->save();

        return \Response::json([
            'success'=>true,
            'avatar'=>asset($destinationPath.$fileName),
            'image'=>$destinationPath.$fileName
        ]);
        //return redirect('user/avatar');
        //dd($user);
    }

    //头像裁剪
    public function cropAvatar(Request $request)
    {
        //dd($request->all());
        //$photo=mb_substr($request->get('photo'),1);
        $photo=$request->get('photo');
        $w=(int)$request->get('w');
        $h=(int)$request->get('h');
        $x=(int)$request->get('x');
        $y=(int)$request->get('y');
        Image::make($photo)->crop($w,$h,$x,$y)->save();

        $user=User::find(Auth::user()->id);
        $user->avatar=asset($photo);
        $user->save();
        return redirect('user/avatar');
    }






}
