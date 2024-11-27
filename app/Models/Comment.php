<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Comment extends Model
{
    Use HasFactory;

    protected $fillable = [
        'commentText', 
        'user_account_id', //(foreign key) user that posted the comment
        'postId' // (foreign key) post commented on
    ];

    public function getUser() 
    {
        return $this->belongsTo(UserAccount::class, 'user_account_id');
    }

    
    public function getPost() 
    {
        return $this->belongsTo(Post::class, 'postId');
    }
}
