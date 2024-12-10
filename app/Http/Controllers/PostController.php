<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; 
class PostController extends Controller
{
    public function store (Request $request) 
    {
        $request->validate([
            'postText' => 'required|string|max:250',
        ]);

        $post = Post::create([
            'postText' => $request->postText,
            'user_account_id' => auth()->id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post Creation Success',
            'post' => $post,
        ]);
    }
}
