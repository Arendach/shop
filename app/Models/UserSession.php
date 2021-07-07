<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserSession
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property string $ssid
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereSsid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereUserId($value)
 * @mixin \Eloquent
 */
class UserSession extends Model
{
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
