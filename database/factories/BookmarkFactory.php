<?php

namespace Database\Factories;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bookmark>
 */
class BookmarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'apartment_id' => $this->faker->numberBetween(1, 200),
            'user_id' => $this->faker->numberBetween(1, 5),
            'date_start' => $start = $this->faker->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
            'date_end' => $this->faker->dateTimeBetween($start, strtotime($start . ' +7 days'))->format('Y-m-d'),


        ];
    }
}
