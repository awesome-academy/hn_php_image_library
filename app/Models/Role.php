<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name',
    ];

    public function permissions()
    {
        return $this->hasManyThrough(Permission::class, 'role_permission', 'role_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'role_id', 'id');
    }
}
