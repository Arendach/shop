<?php

namespace App\StreamTele\Base;

use GuzzleHttp\Client;

class Connection
{
    private $base = 'https://crm.streamtele.com/api/';
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->base
        ]);
    }

    public function post(string $uri, array $data = []): array
    {
        return $this->request($uri, $data, 'POST');
    }

    private function request(string $uri, array $data = [], string $method = 'POST'): array
    {
        $response = $this->client->request($method, $uri, [
            'form_params'    => $data
        ]);

        $body = $response->getBody()->getContents();

        try {
            return json_decode($body, true);
        } catch (\Exception $exception) {
            return [];
        }
    }
}