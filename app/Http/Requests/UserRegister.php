<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|confirmed',
            'password_confirmation'=>'required|min:6'

        ];
    }
    public function messages()
    {
        return [
            'name.required' => '请输入用户名',
            'name.min' => '长度不能小于3',
            'email.required'  => '请输入邮箱账号',
            'email.email'  => '请输入正确邮箱账号',
            'email.unique'  => '该邮箱已经注册',
            'password.required'  => '请输入密码',
            'password.min'  => '长度不能低于6位',
            'password.confirmed'  => '两次密码不一致',
            'password_confirmation.required'  => '请输入确认密码',
            'password_confirmation.min'  => '长度不能低于6位',

        ];
    }
}
