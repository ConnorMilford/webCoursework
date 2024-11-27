<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    Use HasFactory;

    protected $fillable = [
        'postText', 
        'user_account_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_account_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'postId');
    }
}
