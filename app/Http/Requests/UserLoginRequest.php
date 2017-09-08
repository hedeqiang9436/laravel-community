<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required|min:6',
        ];
    }
    public function messages()
    {
        return [
            'email.required'  => '请输入邮箱账号',
            'email.email'  => '请输入正确邮箱账号',
            'email.unique'  => '该邮箱已经注册',
            'password.required'  => '请输入密码',
            'password.min'  => '长度不能低于6位',
        ];
    }
}
