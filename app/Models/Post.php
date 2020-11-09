<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function likes()
    {
        return $this->morphMany(\App\Models\Like::class, 'likeable');
    }

    public function countLikes()
    {
        return $this->likes->count();
    }

    public function isLiked()
    {
        return (bool) $this->likes->where('user_id', Auth::user()->id)->count();
    }
}
