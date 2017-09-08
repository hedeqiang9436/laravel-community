<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Markdown\Markdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use EndaEditor;

class PostsController extends Controller
{
    protected $markdown;
    /**
     * PostsController constructor.
     */
    public function __construct(Markdown $markdown)
    {
        $this->middleware('auth',['only'=>['create','store','update','edit','delete']]);
        $this->markdown=$markdown;
    }

    public function index()
    {
        $discussions=Discussion::all();

        return view('forum.index',compact('discussions'));
    }

    public function show($id)
    {
        $discussion=Discussion::findOrFail($id);
        $html=$this->markdown->markdown($discussion->body);
        return view('forum.show',compact('discussion','html'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
        ],[
            'title.required'=>'请输入标题',
            'body.required'=>'请输入文章正文'
        ]);
       $data=[
         'user_id'=>Auth::user()->id,
         'last_user_id'=>Auth::user()->id,

       ];

        $discussion=Discussion::create(array_merge($request->all(),$data));
        return redirect()->action('PostsController@show',['id'=>$discussion->id]);
    }

    public function edit($id)
    {

        $discussion=Discussion::findOrFail($id);
        if (Auth::user()->id!=$discussion->user_id)
        {
           return redirect('/index');
        }
        return view('forum.edit',compact('discussion'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
        ],[
            'title.required'=>'请输入标题',
            'body.required'=>'请输入文章正文'
        ]);

        $discussion= Discussion::findOrFail($id);
        $discussion->update($request->all());
        return redirect()->action('PostsController@show',['id'=>$discussion->id]);
    }


    public function upload()
    {
        // endaEdit 为你 public 下的目录 update 2015-05-19
        $data = EndaEditor::uploadImgFile('uploads');

        return json_encode($data);
    }
}
