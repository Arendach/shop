<?php

namespace App\Models;

use App\Scopes\OrderScopes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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