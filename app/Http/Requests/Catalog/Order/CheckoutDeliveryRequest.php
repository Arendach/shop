<?php

namespace App\Http\Requests\Catalog\Order;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutDeliveryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delivery_city' => 'required',
            'delivery_date' => 'nullable|date'
        ];
    }

    public function messages()
    {
        return [
            'delivery_city.required' => 'Заповніть місто!',
            'delivery_date.date' => 'Заповніть дату!'
        ];
    }
}
