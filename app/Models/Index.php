<?php

namespace App\Models;

use App\Traits\Models\Phone;
use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    use Translatable;
    use Phone;

    protected $table = 'indexes';

    protected $fillable = [
        'name',
        'logo',
        'header_phone',
        'copyright',
        'footer_phone',
        'footer_address_uk',
        'footer_address_ru',
        'footer_email',
        'is_main '
    ];

    protected $translate = [
        'footer_address'
    ];

    public $timestamps = false;

    protected $casts = [
        'is_main' => 'boolean'
    ];

    public function getLogoImageAttribute()
    {
        return asset($this->logo);
    }
}
