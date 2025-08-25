<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

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

        $sourcePath = database_path('seeders/citiesImages');
        $destinationPath = storage_path('app/public/citiesImages');

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }
        $files = File::files($sourcePath);
        foreach ($files as $file) {
            $destination = $destinationPath . '/' . basename($file);
            File::copy($file->getPathname(), $destination);
        }


        $files = File::files(database_path('seeders/citiesImages'));
       sort($files);

        foreach ($cities as $key => $city) {
            City::create([
                'name' => $city,
                'image' => $files[$key]->getFilename(),
            ]);
        }
    }
}
