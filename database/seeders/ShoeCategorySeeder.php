<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ShoeCategory;

class ShoeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Zapatillas',
            'Zapatillas casuales',
            'Sandalias',
            'Alpargatas',
            'Pantuflas',
        ];

        foreach ($categories as $category) {
            ShoeCategory::create(['name' => $category]);
        }
    }
}
