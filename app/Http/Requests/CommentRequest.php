<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'comment' => 'required|max:500',
            'image' => 'nullable|file',
            'video' => 'nullable|file',
            'user_id' => 'required|numeric',
            'thread_id' => 'required|numeric',
        ];
    }
    
    public function attributes()
    {
        return [
            'comment' => 'コメント',
            'image' => '写真',
            'video' => '動画',
            'user_id' => 'ユーザーID',
            'thread_id' => 'スレッドID',
        ];
    }
}
