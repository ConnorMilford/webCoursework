<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    

    public function run(): void
    {
        DB::table('posts')->truncate();
        User::factory()->count(50)->create();
    }
}
