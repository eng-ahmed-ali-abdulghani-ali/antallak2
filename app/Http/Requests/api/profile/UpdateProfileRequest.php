<?php

namespace App\Http\Requests\api\profile;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],

            'phone' => ['nullable', 'regex:/^(9665\d{8}|05\d{8})$/',
                Rule::unique('users', 'phone')->ignore(Auth::id()),
            ],

            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
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
