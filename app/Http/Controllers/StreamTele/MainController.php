<?php

namespace App\Http\Controllers\StreamTele;

use App\Http\Controllers\Controller;
use App\StreamTele\Exceptions\AuthFailedException;
use App\StreamTele\Sms\Auth;

class MainController extends Controller
{
    public function sectionMain()
    {

    }

    public function Test()
    {
        try {
            $result = app(Auth::class)->smsSend( '0988580982');
            dd($result);
        } catch (AuthFailedException $exception) {

            echo $exception->getMessage();
        }

    }
}