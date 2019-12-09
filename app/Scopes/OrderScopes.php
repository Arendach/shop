<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait OrderScopes
{
    public function scopeDesc(Builder $query)
    {
        $query->orderBy('id', 'desc');
    }
}