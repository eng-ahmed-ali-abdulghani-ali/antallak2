<?php

namespace App\Http\Requests\api\client;

use Illuminate\Foundation\Http\FormRequest;

class GetTripRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [

/*            'service_id' => 'required|exists:services,id',
            'category_id' => 'required|exists:categories,id',
            'payment_method_id' => 'required|exists:payment_methods,id',

            'cit_name' => 'required|string|max:255',

            'pickup_latitude' => 'required|string|max:255',
            'pickup_longitude' => 'required|string|max:255',

            'dropoff_latitude' => 'required|string|max:255',
            'dropoff_longitude' => 'required|string|max:255',*/


        ];
    }
}
