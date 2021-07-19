<?php

namespace App\Http\Controllers\StreamTele;

use App\Http\Controllers\Controller;
use App\StreamTele\Exceptions\AuthFailedException;
use App\StreamTele\Sms\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\Order as sendMail;

class MainController extends Controller
{
    public function sectionMain()
    {

    }

    public function Test()
    {
        $order = Order::first();
        $mail = Mail::to('s5660max@gmail.com')->send(
            new sendMail()
        );
        dd($mail, $order);

        try {
            $result = app(Auth::class)->smsSend( '0988580982');
            dd($result);
        } catch (AuthFailedException $exception) {

            echo $exception->getMessage();
        }

    }
}