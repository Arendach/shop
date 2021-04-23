<?php

namespace App\Library;

use Storage;

class FileImport
{
    public function __construct($url, $to)
    {
        $contents = file_get_contents($url);

        return Storage::put($to, $contents);
    }
}