<?php

namespace App\StreamTele\Sms;

use App\StreamTele\Base\Connection;

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
        $this->idGateway = env('STREAMTELE_PORT', '20555');
        $this->key  = env('STREAMTELE_KEY','key');
        $this->login = env('STREAMTELE_LOGIN', 'login');
        $this->password = env('STREAMTELE_PASSWORD','pass');
        $this->text = setting('streamtele текст смс','Ви успішно Зробили замовлення. Ваш № замовлення:');
        $this->connection = app(Connection::class);


    }

    public static function jobSendSms($phone = null, $orderId = '0', $text = null){
        return app(Auth::class)->smsSend($phone, $orderId, $text);
    }

    public function smsSend($phone = null, $orderId = '0', $text = null)
    {

        if(!$phone)
        {
            return false;
        }
        $this->phone = '38'.$phone;
        try {
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
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return $result = $e->getResponse()->getStatusCode();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $result = $e->getResponse()->getStatusCode();
        }
        return $result;

    }

}