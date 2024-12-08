<?php

namespace Database\Seeders;

use App\Models\UserAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    

    public function run(): void
    {
        Post::truncate();

        $userAccounts = UserAccount::all();

        if ($userAccounts->isEmpty())
        {
            return;
        }

        foreach ($userAccounts as $userAccount) 
        {
            Post::factory()->count(10)->create()->each(function ($post) {
                // Create some comments for each post
                Comment::factory()->count(3)->create([
                    'postId' => $post->id,
                ]);
            });
        }
    }
}
