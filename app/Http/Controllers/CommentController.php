<?php

namespace App\Http\Controllers;
use App\Events\CommentCreated;
use App\Models\Comment;
use App\Models\Post;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // Validate the comment text
        $request->validate([
            'comment' => 'required|string|max:250',
        ]);

        // Create a new comment for the post
        $comment = new Comment();
        $comment->commentText = $request->comment;
        $comment->user_account_id = auth()->id();  
        $comment->postId = $post->id;
        $comment->save();

        event(new CommentCreated($comment));
        return response()->json(['success' => true, 'comment' => $comment]);
    }

}
