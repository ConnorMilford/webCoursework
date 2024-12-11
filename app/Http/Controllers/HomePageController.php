<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomePageController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->with('user')->paginate(15);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post) 
    {
        return view('posts.show', compact('post'));
    }

    public function saved()
    {
        return view('posts.saved', compact('posts'));
    }
}
