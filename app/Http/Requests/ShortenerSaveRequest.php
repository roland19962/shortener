<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShortenerSaveRequest extends FormRequest
{
    public function rules()
    {
        return [
            'url' => ['required', 'string', 'url', 'active_url'],
        ];
    }

    public function messages()
    {
        return [
            'url.required' => 'Field url is required',
            'url.string' => 'Field url is not string',
            'url.url' => 'Field url is not url',
            'url.active_url' => 'Field url is not active',
        ];
    }
}
