<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    Use HasFactory;

    protected $postDetails = [
        'postText', 
        'posterId'
    ];
    
    public function getPoster()
    {
        $this->belongsTo(User::class);
    }
}
