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

    /**
     * Save a post 
     */
    public function savePost(Request $request)
    {
        $request->validate(
            ['postId => required|exists:posts,id']
        );
        
        $user = auth()->user();
        $postId = $request->postId; 

        $savedPosts = $user->saved_posts ?? [];

        if (in_array($postId, $savedPosts)) {
            return response()->json([
                'success' => false,
                'message' => 'Post is already saved.',
            ]);
        }

        $savedPosts[] = $postId;
        
        $user->saved_posts = $savedPosts;
        $user->save();
        

        return response()->json([
            'success' => true,
            'message' => 'Post saved successfully.',
        ]);
    }

    public function unsavePost(Request $request)
    {
        $request->validate([
            'postId' => 'required|exists:posts,id',  
        ]);

        $user = auth()->user();
        $postId = $request->postId;

        $user->saved_posts = array_filter($user->saved_posts, function ($savedPostId) use ($postId) {
            return $savedPostId != $postId;
        });

        $user->saved_posts = array_values($user->saved_posts); 
        $user->save();  

        return response()->json([
            'success' => true,
            'message' => 'Post unsaved successfully!',
        ]);
    }
    

}
