<?php

namespace App\Http\Requests\api\client;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpClientRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'size:4', 'regex:/^\d{4}$/'],
            'phone' => ['required', 'regex:/^9665\d{8}$/'],
        ];
    }
}
