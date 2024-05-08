<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo de nome é obrigatório.'
        ];
    }
}
