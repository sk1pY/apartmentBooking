<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $files = File::files(database_path('seeders/apartmentsImages'));

        return [
            'name' => $this->faker->word(),
            'address' => $this->faker->address(),
            'price' =>$this->faker->numberBetween(50,100),
            'image' => $files ? $files[array_rand($files)]->getFilename() : null,
            'city_id' => $this->faker->numberBetween(1, 6),
            'user_id' => $this->faker->numberBetween(1, 11),
        ];
    }
}
