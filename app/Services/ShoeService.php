<?php

namespace App\Services;

use App\Models\Shoe;
use App\Models\ShoeDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class ShoeService
{
    public function index(): Collection
    {
        $shoes = Shoe::select('*')->where('stock', '>', 0)->orWhere('is_discontinued', '=', 0)->get();
        return $shoes;
    }

    public function show(int $id): Shoe
    {
        $shoe = Shoe::with('shoeDetail')->findOrFail($id);
        return $shoe;
    }

    public function store(array $data): Shoe 
    {
        return DB::transaction(function() use ($data){
            $shoe_detail = ShoeDetail::firstOrCreate([
                'category_id' => $data['category'],
                'brand' => $data['brand'],
                'model' => $data['model'],
            ],[
                'description' => $data['description'] ?? null,
                'base_price' => $data['base_price'],
            ]);

            $shoe = Shoe::create([
                'sku' => $data['sku'],
                'shoe_detail_id' => $shoe_detail->id,
                'color' => $data['color'],
                'size' => $data['size'],
                'stock' => $data['stock'],
                'promo_price' => $data['promo_price'] ?? null,
                'is_promotion' => isset($data['promo_price']) ? true : false,
            ]);

            $shoe->refresh();
            return $shoe;
        });
    }

    public function update(int $id, array $data): Shoe
    {
        $shoe = Shoe::findOrFail($id);
        $shoe_detail = $shoe->shoeDetail;

        DB::transaction(function() use ($shoe, $shoe_detail, $data){
            $shoe_detail->update([
                'category_id' => $data['category'],
                'brand' => $data['brand'],
                'model' => $data['model'],
                'description' => $data['description'] ?? null,
                'base_price' => $data['base_price'],
            ]);

            $shoe->update([
                'color' => $data['color'],
                'size' => $data['size'],
                'stock' => $data['stock'],
                'promo_price' => $data['promo_price'] ?? null,
                'is_promotion' => isset($data['promo_price']) ? true : false,
            ]);
        });

        $shoe->refresh();
        return $shoe;
    }

    public function soft_delete(int $id): void
    {
        $shoe = Shoe::findOrFail($id);
        $shoe->update(['is_discontinued' => true]);
    }

    public function destroy(int $id): void
    {
        $shoe = Shoe::findOrFail($id);
        $shoe->delete();
    }
}