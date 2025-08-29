<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sourcePath = database_path('seeders/apartmentsImages');
        $destinationPath = storage_path('app/public/apartmentsImages');

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }
        $files = File::files($sourcePath);
        foreach ($files as $file) {
            $destination = $destinationPath . '/' . basename($file);
            File::copy($file->getPathname(), $destination);
        }

        Apartment::factory()->count(200)->create();
    }
}
