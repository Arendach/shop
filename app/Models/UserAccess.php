<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserAccess
 *
 * @property int $id
 * @property string $access_keys
 * @property string $name
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereAccessKeys($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereName($value)
 * @mixin \Eloquent
 */
class UserAccess extends Model
{
    protected $table = 'user_access';

    public function getAccessKeysAttribute($value)
    {
        return explode(',', $value);
    }
}
