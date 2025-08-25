<?php

namespace Database\Factories;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateStart = $this->faker->dateTimeBetween('now', '+1 month');

        return [
            'apartment_id' => Apartment::inRandomOrder()->first()->id,
            'user_id' => $this->faker->numberBetween(1, 11),
            'date_start' => $dateStart->format('Y-m-d'),
            'date_end' => $this->faker->dateTimeBetween($dateStart, '+1 month')->format('Y-m-d'),];
    }
}
