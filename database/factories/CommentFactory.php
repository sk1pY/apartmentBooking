<?php

namespace Database\Factories;

use App\Models\Apartment;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'text' => $this->faker->realText(),
            'rating' => $this->faker->numberBetween(1,5),
            'apartment_id' => $this->faker->numberBetween(1,200),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Comment $comment) {
            $apartment =$comment->apartment()->first();
            $avgRating =$apartment->comments()->avg('rating');
            $apartment->avgRating = $avgRating;
            $apartment->save();
        });
    }
}
