<?php

namespace Database\Factories;


use App\Models\UserAccount;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'postText' => $this->faker->sentence(),
            'user_account_id' => UserAccount::pluck('id')->random(),
            'photo' => $this->faker->imageUrl(600, 400, 'technology', true, 'photo'),
        ];
    }
}
