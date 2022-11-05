<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'         => ['required', 'string'],
            'content'       => ['nullable', 'string'],
            'categories'    => ['nullable', 'array'],
        ];
    }
}
