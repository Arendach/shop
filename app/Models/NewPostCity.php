<?php

namespace App\Models;

use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewPostCity extends Model
{
    use Translatable;

    protected $table = 'new_post_cities';

    protected $fillable = [
        'name_uk',
        'name_ru',
        'ref',
        'prefix'
    ];

    public $timestamps = true;

    protected $translate = ['name'];

    public function warehouses(): HasMany
    {
        return $this->hasMany(NewPostWarehouse::class, 'city_id');
    }
}
