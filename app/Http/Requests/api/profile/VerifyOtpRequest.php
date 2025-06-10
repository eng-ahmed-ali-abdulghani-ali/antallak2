<?php

namespace App\Http\Requests\api\profile;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VerifyOtpRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'otp' => ['required', 'string', 'size:4', 'regex:/^\d{4}$/'],
            'phone' => ['required', 'regex:/^(9665\d{8}|05\d{8})$/'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 422,
            'message' => $validator->errors()->first(),
        ], 422));
    }
}
