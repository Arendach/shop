<?php

namespace App\Models;

use App\Traits\Models\Image;
use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Menu extends Model implements Sortable
{
    use Translatable;
    use SortableTrait;
    use Image;

    protected $table = 'menu';

    public $timestamps = false;

    public $translate = ['name'];

    public $sortable = [
        'order_column_name'  => 'sort',
        'sort_when_creating' => true,
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }
}
