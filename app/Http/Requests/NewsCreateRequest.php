<?php

namespace App\Http\Requests;

class NewsCreateRequest extends \StarterKit\News\Http\Requests\NewsRequest
{
    public function rules()
    {
        return [
            'title.' . config('app.locale') => 'required',
            'contents.' . config('app.locale') => 'required',
            'image' => ['required', 'image'],
        ];
    }
}
