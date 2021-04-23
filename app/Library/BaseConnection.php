<?php

namespace App\Library;

use GuzzleHttp\Client;

class BaseConnection
{
    public function request($controller, $method, $parameters = [])
    {
        $request_url = config('app.base_url') . '/api/' . $controller . '/' . $method;

        $request = (new Client())->request('POST', $request_url, [
            'query' => $parameters,
            'exceptions' => true
        ]);

        if ($request->getStatusCode() == 200)
            return $request->getBody()->getContents();
        else
            return abort($request->getStatusCode());
    }

    public function requestParse($controller, $method, $parameters = [])
    {
        return json_decode($this->request($controller, $method, $parameters));
    }
}