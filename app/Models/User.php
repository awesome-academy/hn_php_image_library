<?php

namespace App\Models;

use App\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'bio',
        'avatar',
        'password',
        'role_id',
        'is_active',
        'api_token',
    ];

    protected $attributes = [
        'role_id' => 0,
        'is_active' => 1,
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'id' => 'int',
        'deleted_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'user_id', 'id');
    }

    public function follows()
    {
        return $this->hasMany(Follow::class, 'user_id', 'id');
    }

    public function receivesBroadcastNotificationsOn()
    {
        return 'users.' . $this->id;
    }
}
