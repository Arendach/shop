<?php

namespace App\Traits\Models;

use Agent;

trait Editable
{
    public function editable(string $field, $multiLang = true)
    {
        // if not auth
        if (!customer()->is_editable || !Agent::isDesktop()) {
            return $this->$field;
        }


        $prefix = $multiLang ? '_' . config('locale.current') : '';

        return view('catalog.assets.content-editable', [
            'model' => $this,
            'field' => $field . $prefix,
        ])->render();
    }
}