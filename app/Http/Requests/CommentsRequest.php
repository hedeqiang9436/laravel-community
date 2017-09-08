<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsRequest extends FormRequest
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
            'body'=>'required|min:10',
            'discussion_id'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'body.required'  => '请输入评论内容',
            'body.min'  => '最少不能低于10位',
            'discussion_id'=>'文章缺少'
        ];
    }
}
