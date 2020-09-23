<?php

namespace App\Http\Requests\Catalog\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $orderTypes = array_keys(asset_data('order_types'));
        $payMethods = array_keys(asset_data('pay_methods'));
        $thisDate = date('Y-m-d');
        $rules = [];

        if (request('delivery') == 'delivery') {
            $rules = [
                'city'          => 'required|max:256',
                'street'        => 'required|max:256',
                'address'       => 'nullable|max:256',
                'date_delivery' => "nullable|after:{$thisDate}"
            ];
        } elseif (request('delivery') == 'sending') {
            $rules = [
                'warehouse_id' => 'required|exists:new_post_warehouses,id'
            ];
        } elseif (request('delivery') == 'self') {
            $rules = [
                'shop_id'       => 'required|exists:shops,id',
                'date_delivery' => "nullable|after:{$thisDate}"
            ];
        }

        return array_merge($rules, [
            'first_name' => 'required|max:32',
            'last_name'  => 'required|max:32',
            'phone'      => ['required', 'regex:/[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}/'],
            'email'      => 'nullable|email|max:64',
            'password'   => [Rule::requiredIf(!isAuth()), 'min:6', 'max:32', 'confirmed'],
            'comment'    => 'max:1024',
            'delivery'   => ['required', Rule::in($orderTypes)],
            'pay_method' => ['required', Rule::in($payMethods)]
        ]);
    }

    public function attributes(): array
    {
        return [
            'first_name' => translate('Імя'),
            'last_name'  => translate('Прізвище'),
            'phone'      => translate('Телефон'),
            'email'      => translate('Електронна пошта'),
            'password'   => translate('Пароль'),
            'shop_id'    => translate('Магазин')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
