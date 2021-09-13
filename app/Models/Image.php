<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'images';

    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'category_id',
        'description',
        'original_link',
        'thumb_link',
        'download',
        'like',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'image_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function shares()
    {
        return $this->belongsToMany(User::class, 'user_share', 'image_id', 'user_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'user_like', 'image_id', 'user_id');
    }
}
