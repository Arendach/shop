<?php

namespace App\Models;

use App\Traits\Models\Editable;
use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use Translatable;
    use Editable;

    protected $fillable = [];
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'faqs';

    public $translate = [
        'answer',
        'question',
    ];
}
