<?php

namespace App\Services;

use App\Models\Shoe;
use App\Models\ShoeDetail;
use Illuminate\Database\Eloquent\Collection;

class ShoeService
{
    public function index(): Collection
    {
        $shoes = Shoe::select('*')->where('stock', '>', 0)->orWhere('is_discounted', '=', 0)->get();
        return $shoes;
    }

    public function store(array $data): Shoe 
    {
        $shoe_detail = ShoeDetail::create([
            'category_id' => $data['category'],
            'brand' => $data['brand'],
            'model' => $data['model'],
            'base_price' => $data['base_price'],
        ]);

        $shoe_detail->refresh();

        $shoe = Shoe::create([
            'shoe_detail_id' => $shoe_detail->id,
            'size' => $data['size'],
            'color' => $data['color'],
            'stock' => $data['stock'],
            'promo_price' => $data['promo_price'] ?? null,
        ]);

        $shoe->refresh();
        
        return $shoe;
    }
}