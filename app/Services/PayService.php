<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Collection;
use Log;
use App\Models\Payment;
use App\Models\Price;

class PayService
{
    private $pays;

    /**
     * PayService constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        if (!is_file(base_path('assets/pay_methods.php'))) {
            throw new Exception('Файл з способами оплати відсутній!');
        }

        $this->pays = include base_path('assets/pay_methods.php');

        $this->boot();
    }

    /**
     * @throws \Exception
     */
    private function boot()
    {
        $pays = [];

        foreach ($this->pays as $key => $pay) {
            if (!isset($pay['name'])) {
                throw new Exception('Назва способу оплати не вказана!');
            }

            $pays[$key] = collect($pay);
        }

        $this->pays = $pays;
    }

    public function all()
    {
        return $this->pays;
    }

    public function get(string $key): Collection
    {
        return $this->pays[$key];
    }

    /**
     * Валідація форми оформлення замовлення
     * @param $request
     */
    public function validateCheckout($request): void
    {

    }

    public function getPayMethodNames(): array
    {
        // $result = [];
        // $payMethods = asset_data('pay_methods');
        // foreach ($payMethods as $key => $pay) {
        //     $result[] = [
        //         'key'  => $key,
        //         'name' => $pay['name']
        //     ];
        // }

        $result1 = [];
        $results = Payment::where('active', true)->orderBy('id', 'ASC')->get();
        foreach ($results as $res) {
            $result1[] = [
                'key'         => $res['key'],
                'name'        => $res['name'],
                'description' => $res['description']
            ];
        }

        //dd($result1);
        return $result1;
    }


    public function getPriceOne(): array
    {
        return [
            'day_no_one'     => setting('Вартість достаки - День(сума < 1000)', '80'),
            'day_one'        => setting('Вартість достаки - День(сума >= 1000', '0'),
            'night_no_one'   => setting('Вартість достаки - Ніч(сума < 1000)', '200'),
            'night_one'      => setting('Вартість достаки - Ніч(сума >= 1000)', '100'),
            'morning_no_one' => setting('Вартість достаки - Ранок, Вечір (сума < 1000)', '100'),
            'morning_one'    => setting('Вартість достаки - Ранок, Вечір (сума >= 1000)', '70')
        ];
    }


}