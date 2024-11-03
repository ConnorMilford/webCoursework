<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Comment extends Model
{
    Use HasFactory;

    protected $commentDetails = [
        'commentText', 
        'userId', //(foreign key) user that posted the comment
        'postId' // (foreign key) post commented on
    ];

    public function getUser() 
    {
        return $this->belongsTo(User::class);
    }

    
    public function getPost() 
    {
        return $this->belongsTo(Post::class);
    }
}
