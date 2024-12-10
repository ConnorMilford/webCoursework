<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class UserAccount extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    //posts and comments will be arrays of comment and post IDS
    protected $fillable = [
        'userName',
        'password',
        'email',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function posts() 
    {
        return $this->hasMany(Post::class, 'user_account_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
