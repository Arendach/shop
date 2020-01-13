<?php

namespace App\Models;

use App\Scopes\OrderScopes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $phone
 * @property int $access
 * @property string $locale
 * @property string $role
 * @property int $base_id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserSession[] $sessions
 * @property-read int|null $sessions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $desire_products
 * @property-read int|null $desire_products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User desc()
 * @property int $access_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAccessId($value)
 */
class User extends Authenticatable
{
    use Notifiable;
    use OrderScopes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'locale',
        'phone',
        'access_id',
        'base_id',
        'role',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sessions()
    {
        return $this->hasMany('App\Models\UserSession');
    }

    public function getAccessAttribute($value)
    {
        if ($value != 0 && $value != -1) return UserAccess::find($value)->access_keys ?? 0;
        else return $value;
    }

    public function orders()
    {
        return $this->hasMany(Order::class)
            ->orderByDesc('id')
            ->with(['products', 'self', 'sending', '_delivery']);
    }

    public function desire_products()
    {
        return $this->belongsToMany(Product::class, DesireProduct::class);
    }
}
