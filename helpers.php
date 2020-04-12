<?php

use App\Models\Customer;
use App\Services\AuthService;

define('DS', DIRECTORY_SEPARATOR);

function isAuth(): bool
{
    return app(AuthService::class)->isAuth();
}

function translate($text)
{
    return Translate::get($text);
}

function translate_text($text, string $language): ?string
{
    return app(\App\Services\TranslateTextService::class)->get($text, $language);
}

function customer(int $id = 0): Customer
{
    if ($id == 0 && isAuth()) {
        return app(AuthService::class)->getCustomer();
    } elseif (is_numeric($id) && $id > 0) {
        $user = Customer::find($id);

        if (!is_null($user)) {
            return $user;
        }
    }

    return new Customer;
}

function asset_data(string $filename): array
{
    if (is_file(base_path("assets/$filename.php"))) {
        $result = include base_path("assets/$filename.php");

        if (is_array($result)) return $result;
    }

    return [];
}

/**
 * @param array $parameters
 * @return string
 */
function parameters(array $parameters): string
{
    $string = '?';
    foreach ($parameters as $key => $value)
        $string .= $key . '=' . $value . '&';
    return substr($string, 0, strlen($string) - 1);
}

/**
 * @param array $parameters
 * @return string
 */
function params(array $parameters): string
{
    // return preg_replace('@^\?@', '', parameters($parameters));
    return trim(parameters($parameters), '?');
}

/**
 * @param $data
 * @param int $status
 * @param array $headers
 * @param int $option
 * @return \Illuminate\Http\JsonResponse
 * @deprecated
 */
function json($data, $status = 200, $headers = [], $option = 0)
{
    return response()->json($data, $status, $headers, $option);
}

function artisan($command)
{
    return Artisan::call($command);
}