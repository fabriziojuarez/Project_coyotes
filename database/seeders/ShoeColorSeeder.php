<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ShoeColor;

class ShoeColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'Negro',
            'Blanco',
            'Azul',
            'Rojo',
            'Verde',
            'Marron',
        ];

        foreach ($colors as $color) {
            ShoeColor::create(['color' => $color]);
        }
    }
}
