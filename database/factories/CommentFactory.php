<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            //userId and postId set explicitly in the seeder. 
            'commentText' => $this->faker->sentence(),
            'user_account_id' => User::pluck('id')->random(),
            'postId' => Post::pluck('id')->random(),
        ];
    }
}
