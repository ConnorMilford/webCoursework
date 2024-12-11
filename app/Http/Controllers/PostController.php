<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; 
use Illuminate\Support\Facades\Auth;

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

    public function update (Request $request, Post $post) 
    {
        if (Auth::id() !== $post->user_account_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'postText' => 'required|string|max:250',
        ]);

        $post->update(['postText' => $request->postText]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully!',
                'postText' => $post->postText,  // Optionally, send the updated text back
            ]);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        // Authorization Check
        if (Auth::id() !== $post->user_account_id) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    

}
