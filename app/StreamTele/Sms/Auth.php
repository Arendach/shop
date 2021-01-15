<?php

namespace App\StreamTele\Sms;

use App\StreamTele\Base\Connection;
use App\StreamTele\Exceptions\AuthFailedException;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\Catalog\Order\CheckoutRequest;
use GuzzleHttp\Client;
use App\Models\Order;

class Auth
{
    private $connection;
    private $login;
    private $password;
    private $key;
    private $action;
    private $idGateway;
    public function __construct()
    {
        $this->idGateway = setting('streamtele шлюз', '20555');
        $this->login = setting('streamtele логін', 'login');
        $this->password = setting('streamtele пароль','pass');
        $this->key  = setting('streamtele ключ','627a3613');
        $this->text = setting('streamtele текст смс','Ви успішно Зробили замовлення. Ваш № замовлення:');
        $this->connection = app(Connection::class);


    }

    /**
     * @return string
     */
    public function smsSend($phone = false, $orderId = false, $text = false)
    {

        if(!$phone)
        {
            return false;
        }
        $this->phone = '38'.$phone;

        $this->action = 'smssend';

        $result = $this->connection->post('sms', [
                'username'          => $this->login,
                'password'          => $this->password,
                'api_key'           => $this->key,
                'action'            => $this->action,
                'sms_gateway_id'    => $this->idGateway,
                'sms_text'          => $text ?? $this->text .' '. $orderId,
                'sms_phone'         => $this->phone
        ]);
        return $result;

    }

}