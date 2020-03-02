<?php

namespace App\Traits\Models;

trait Translatable
{
    public function __get($name)
    {

        if (isset($this->translate) && in_array($name, $this->translate)) {
            return $this->{$name . '_' . config('locale.current')};
        }

        return parent::__get($name);
    }
}