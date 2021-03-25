<?php

namespace App\Models;

use App\Scopes\SortableScope;
use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use Translatable;

    public $translate = [
        'question',
        'answer'
    ];
    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];
    protected $guarded = [];

    public $timestamps = true;

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'question_category', 'question_id', 'category_id');
    }

    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(ProductCollection::class, 'question_collection', 'question_id', 'collection_id');
    }


}
