<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ShoeSize;

class ShoeSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            ['us_size' => 7, 'eur_size' => 39, 'uk_size' => 6, 'cm_size' => 25.6],
            ['us_size' => 7.5, 'eur_size' => 40, 'uk_size' => 6.5, 'cm_size' => 25.7],
            ['us_size' => 8, 'eur_size' => 41, 'uk_size' => 7, 'cm_size' => 25.8],
            ['us_size' => 9, 'eur_size' => 42, 'uk_size' => 8, 'cm_size' => 26],
            ['us_size' => 9.5, 'eur_size' => 42.5, 'uk_size' => 8.5, 'cm_size' => 26.4],
            ['us_size' => 10, 'eur_size' => 43, 'uk_size' => 9, 'cm_size' => 26.8],
        ];

        foreach ($sizes as $size) {
            ShoeSize::create($size);
        }
    }
}
