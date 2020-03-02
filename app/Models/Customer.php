<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'phone',
        'email',
        'password',
        'first_name',
        'last_name',
        'locale'
    ];

    public function getNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }
}
