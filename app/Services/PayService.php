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
        $results = Payment::where('active',true)->orderBy('id','ASC')->get();
        foreach ($results as $res) {
            $result1[] = [
                'key'  => $res['key'],
                'name' => $res['name'],
                'description' => $res['description']
            ];
        }

        //dd($result1);
        return $result1;
    }



    public function getPriceOne(): Array
    {

        //dd((int) setting('get_day_no_one'));
        $resultss = Price::where('id','=','1')->first();
        // foreach ($resultss as $res) {
        //     $result1[] = ;
        // }
        // dd(json_decode(json_encode($resultss)));
        //$res = json_decode(json_encode($resultss));
        //dd($res);
        $resultss = [
            'day_no_one'        => $resultss->day_no_one,
            'day_one'           => $resultss->day_one,
            'night_no_one'      => $resultss->night_no_one,
            'night_one'         => $resultss->night_one,
            'morning_no_one'    => $resultss->morning_no_one,
            'morning_one'       => $resultss->morning_one
        ];
        return $resultss;
    }


}