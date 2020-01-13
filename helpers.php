<?php

define('DS', DIRECTORY_SEPARATOR);

function is_auth(): bool
{
    return \Auth::is_auth();
}

function translate($text)
{
    return Translate::get($text);
}


function user(int $id = 0)
{
    if ($id == 0 && is_auth()) {
        return \Auth::getUser();
    } elseif (is_numeric($id) && $id > 0) {
        $user = \App\Models\User::find($id);

        if (!is_null($user))
            return $user;
    }

    return new \App\Models\User();
}

/**
 * @param $key
 * @param int $user_id
 * @return bool
 */
function access($key, $user_id = 0): bool
{
    if (!is_auth()) return false;

    $user = user($user_id);

    // root
    if ($user->access == -1) return true;

    // в користувача є ключ
    if (preg_match('@,@', $user->access)) {
        $keys = explode(',', $user->access);
        if (in_array($key, $keys))
            return true;
    }

    return false;
}

function is_admin(int $id = 0): bool
{
    $role = user($id)->role ?? '';

    return $role == 'admin';
}

/**
 * @param string $filename
 * @return array
 */
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
 */
function json($data, $status = 200, $headers = [], $option = 0)
{
    return response()->json($data, $status, $headers, $option);
}