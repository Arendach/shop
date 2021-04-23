<?php

namespace App\Models\Crm;
use Illuminate\Database\Eloquent\Model as Base;

class Model extends Base
{
    protected $connection = "crm";


    public function getUrl(string $path): string
    {
        $path = trim($path, '/');

        return config('app.base_url'). "/". $path;
    }
}