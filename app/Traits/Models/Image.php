<?php

namespace App\Traits\Models;

trait Image
{
    public function getImage(string $key = 'image'): ?string
    {
        if (is_null($this->$key)) {
            return null;
        }

        if (is_file(public_path($this->$key)) || preg_match('~^http~', $this->$key)) {
            return asset($this->$key);
        } else {
            if (isset($this->images[$key])) {
                return asset($this->images[$key]);
            }

            return asset(config('default.image.common'));
        }
    }
}