<?php

namespace App\Http\Requests\Catalog\Order;

use App\Rules\EmailUnique;
use App\Rules\PhoneUnique;
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
        $rulesAuth = [];



        if (request('delivery') == 'delivery') {
            $rules = [
                'city'          => 'required|max:256',
                'street'          => 'max:256',
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


        if (!isAuth() AND request('create_account')) {
            $rulesAuth = [
                'email'    => ['nullable', 'email', 'max:256', new EmailUnique],
                'phone'    => ['required', 'max:256', new PhoneUnique],
                'password' => 'required|min:8|max:16|confirmed'
            ];
        }

        return array_merge($rules, [
            'first_name' => 'required|max:32',
            'phone'      => ['required', 'regex:/[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}/'],
            'comment'    => 'max:1024',
            'delivery'   => ['required', Rule::in($orderTypes)],
            'pay_method' => ['required', Rule::in($payMethods)]
        ], $rulesAuth);
    }

    public function attributes(): array
    {
        return [
            'first_name'    => translate('Імя'),
            'last_name'     => translate('Прізвище'),
            'phone'         => translate('Телефон'),
            'email'         => translate('Електронна пошта'),
            'password'      => translate('Пароль'),
            'shop_id'       => translate('Магазин'),
            'city'          => translate('Місто'),
            'street'        => translate('Вулиця'),
            'date_delivery' => translate('Дата доставки')
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
