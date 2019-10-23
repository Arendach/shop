<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Collection;
use Log;

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
}