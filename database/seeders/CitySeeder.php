<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Минск',
            'Гомель',
            'Гродно',
            'Витебск',
            'Могилёв',
            'Брест',
            'Бобруйск',
            'Барановичи',
            'Борисов',
            'Пинск'
        ];

        foreach ($cities as $city) {
            City::create([
                'name' => $city,
            ]);
        }
    }
}
