<?php

namespace Database\Seeders;

use App\Models\UserAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

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
            Post::factory()->create([
                'user_account_id' => $userAccount->id, 
            ]);
        }
    }
}
