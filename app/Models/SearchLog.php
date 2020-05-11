<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SearchLog
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $query
 * @property string|null $user_agent
 * @property int $is_show
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SearchLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SearchLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SearchLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SearchLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SearchLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SearchLog whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SearchLog whereQuery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SearchLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SearchLog whereUserAgent($value)
 * @mixin \Eloquent
 */
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
