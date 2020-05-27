<?php

namespace App\Models;

use App\Traits\Models\Editable;
use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
    use Editable;

    protected $fillable = [
        'original',
        'content_ru',
        'content_uk'
    ];

    public function getContentAttribute()
    {
        return $this->{"content_" . config('locale.current')};
    }
}
