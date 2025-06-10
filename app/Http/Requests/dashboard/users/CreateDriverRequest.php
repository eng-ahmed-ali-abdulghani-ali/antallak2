<?php

namespace App\Http\Requests\dashboard\users;

use Illuminate\Foundation\Http\FormRequest;

class CreateDriverRequest extends FormRequest
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
      'name' => 'required|string|max:255',
      'birth_date' => 'required|date|before:-18 years',
      'iqama_number' => 'required|string|max:255',
      'iqama_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
      'license_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
      'vehicle_license_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
      'selfie_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
      'vehicle_front_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
      'vehicle_back_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
      'password' => 'required|string|min:8',
      'phone' => 'required|string|max:15',
    ];
  }
}
