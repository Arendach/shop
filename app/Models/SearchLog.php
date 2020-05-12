<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    protected $table = 'search_logs';

    public $timestamps = true;

    protected $fillable = [
        'query',
        'user_agent',
        'is_show'
    ];
}
