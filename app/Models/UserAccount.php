<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAccount extends Model
{
    use HasFactory;

    //posts and comments will be arrays of comment and post IDS
    protected $fillable = [
        'userName',
        'user_id',
    ];


    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function posts() 
    {
        return $this->hasMany(Post::class, 'user_account_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
