<?php

namespace App\Http\Requests\dashboard\service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {

    return [
      'name' => [
        $this->isMethod('PUT') ? 'required' : 'sometimes',
        'string',
        Rule::unique('services', 'name')->ignore($this->service),
      ],
      'img' => [
        'nullable',
        'image',
        'mimes:jpg,jpeg,png,webp',
        'max:2048',
      ],
    ];
  }
}
