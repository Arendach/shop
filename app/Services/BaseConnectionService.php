<?php

namespace App\Services;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Log;
use Exception;

class BaseConnectionService
{
    /**
     * @var Client
     */
    private $connection;

    /**
     * @var null|string|Response
     */
    private $result;

    /**
     * @var string
     */
    private $controller = 'test';

    /**
     * @var string
     */
    private $method = 'connection';

    /**
     * @var array
     */
    private $parameters = [];

    /**
     * @var bool
     */
    public static $debug = false;

    /**
     * BaseConnectionService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->connection = $client;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return config('app.base_url') . '/api/' . $this->controller . '/' . $this->method;
    }

    /**
     * @param $controller
     * @param $method
     * @param array $parameters
     * @return $this
     */
    public function request($controller, $method, $parameters = [])
    {
        $this->controller = $controller;
        $this->method = $method;
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @param $controller
     * @param $method
     * @param array $parameters
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function exec($controller, $method, $parameters = [])
    {
        return $this
            ->request($controller, $method, $parameters)
            ->sendRequest()
            ->resultParse()
            ->getResult();
    }

    /**
     * @return $this
     */
    public function resultParse()
    {
        if (static::$debug)
            dd((string)$this->result->getBody());

        $this->result = json_decode((string)$this->result->getBody());

        return $this;
    }

    /**
     * @return mixed
     */
    private function getResult()
    {
        return $this->result;
    }

    /**
     * @return $this
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function sendRequest()
    {
        $path = $this->getPath();

        try {
            $this->result = $this->connection->request('POST', $path, [
                'query' => $this->parameters,
                'exceptions' => true
            ]);
        } catch (Exception $exception) {
            $this->result = null;
            $this->exception($exception);
        }

        return $this;
    }

    /**
     * @param Exception $exception
     * @throws Exception
     * @return void
     */
    private function exception(Exception $exception): void
    {
        $message = 'Зєднання з базою не вдалось! -> ' . $exception->getMessage();

        Log::error($message, [
            'controller' => $this->controller,
            'method' => $this->method,
            'path' => $this->getPath(),
            'parameters' => $this->parameters,
            'date' => Carbon::now()->format('d / m / Y H:i')
        ]);

        if (env('APP_DEBUG'))
            throw new Exception($message, 500);
    }
}