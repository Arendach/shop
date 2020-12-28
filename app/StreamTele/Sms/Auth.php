<?php

namespace App\StreamTele\Sms;

use App\StreamTele\Exceptions\AuthFailedException;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\Catalog\Order\CheckoutRequest;
use GuzzleHttp\Client;


class Auth
{
    private $connection;
    private $login;
    private $password;
    private $key;
    private $base_url;
    private $action;
    private $idGateway;
    public function __construct(CheckoutRequest $request)
    {
        $this->idGateway = '20555'; // Id Смс-Шлюза
        $this->base_url = 'https://crm.streamtele.com/api/';
        $this->login = 'roma4891'; //setting('Логін до streamtele')
        $this->password = 'LgfSiUXO';  //setting('Пароль до streamtele');
        $this->key  = '627a3613da2828b89f1d4ebbd715acf3'; //setting('key до streamtele')
        $this->action = 'smssend';
        $this->text = 'Вы успешно Сделали заказ. Ваш № заказа:';
        $this->phone = '38'.$request->phone;
    }

    /**
     * @return string
     */
    public function getSms($orderId)
    {
        $client = new Client(['base_uri' => $this->base_url]);
        $response = $client->request(
            'POST',
            'sms',
            ['form_params' => [
                'username'          => $this->login,
                'password'          => $this->password,
                'api_key'           => $this->key,
                'action'            => $this->action,
                'sms_gateway_id'    => $this->idGateway,
                'sms_text'  => $this->text.' '.$orderId,
                'sms_phone' => $this->phone
            ]
        ]);
        $result = json_decode($response->getBody()->getContents());
        if ($result->result == 'ok')
            return true;
        else
            return false;
    }

}