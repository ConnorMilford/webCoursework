<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        // removes all coments from db
        DB::table('comments')->truncate();

        $users = User::all();
        $posts = Post::all();

        // if users or posts is empty return nothing
        if ($users->isEmpty() || $posts->isEmpty()) 
        {
            return;
        }

    
        // create comments from users and posts
        foreach ($posts as $post)
        {
            foreach ($users as $user)
            {
                Comment::factory()->create([
                    'user_account_id' => $user->id,
                    'postId' => $post->id
                ]);
            }
        }
    }
}
