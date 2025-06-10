<?php

namespace App\Http\Requests\api\client;

use Illuminate\Foundation\Http\FormRequest;

class SignUpClientRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^9665\d{8}$/', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }


}
