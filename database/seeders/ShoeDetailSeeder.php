<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ShoeDetail;

class ShoeDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShoeDetail::create([
            'category_id' => 2,
            'brand' => 'Nike',
            'model' => 'Air Max 90',
            'base_price' => 120.00,
            'description' => 'Classic Nike Air Max 90 with a timeless design and comfortable cushioning.',
        ]);

        ShoeDetail::create([
            'category_id' => 2,
            'brand' => 'Adidas',
            'model' => 'Ultraboost 22',
            'base_price' => 180.00,
            'description' => 'Adidas Ultraboost 22 offers exceptional comfort and energy return for runners.',
        ]);

        ShoeDetail::create([
            'category_id' => 3,
            'brand' => 'Timberland',
            'model' => '6-Inch Premium Boot',
            'base_price' => 200.00,
            'description' => 'Durable and stylish Timberland 6-Inch Premium Boot, perfect for outdoor adventures.',
        ]);
    }
}
