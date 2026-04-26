<?php

namespace App\Services;

use App\Models\ShoeDetail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ShoeDetailService
{
    public function index(): Collection
    {
        $shoe_details = ShoeDetail::query()
            ->where('is_discontinued', false)
            ->whereHas('shoes', function($query){
                $query->where('stock', '>', 0);
                $query->where('is_hidden', false);
            })
            ->get();

        return $shoe_details;
    }

    public function store(array $data): ShoeDetail
    {
        return DB::transaction(function() use ($data){
            $shoe_detail = ShoeDetail::firstOrCreate([
                'category_id' => $data['category'],
                'brand' => $data['brand'],
                'model' => $data['model'],
            ],[
                'description' => $data['description'] ?? null,
                'base_price' => $data['base_price'],
                'is_discontinued' => false,
            ]);

            $shoe_detail->refresh();
            return $shoe_detail;
        });
    }

    public function update(int $id, array $data): ShoeDetail
    {
        $shoe_detail = ShoeDetail::findOrFail($id);
        
        return DB::transaction(function() use ($shoe_detail, $data){
            $duplicate_fields = ShoeDetail::query()
                ->where('id', '!=', $shoe_detail->id)
                ->where('category_id', $data['category'])
                ->where('brand', $data['brand'])
                ->where('model', $data['model'])
                ->exists();

            if ($duplicate_fields) {
                throw new \InvalidArgumentException('Detalles del calzado ya registrados');
            }

            $shoe_detail->update([
                'category_id' => $data['category'],
                'brand' => $data['brand'],
                'model' => $data['model'],
                'description' => $data['description'] ?? null,
                'base_price' => $data['base_price'],
                'promo_descount' => $data['promo_descount'] ?? null,
                'promo_price' => isset($data['promo_descount']) ? $data['base_price'] * (1 - $data['promo_descount'] / 100) : null,
                'is_promotion' =>  isset($data['promo_descount']) ? true : false,
            ]);

            $shoe_detail->refresh();
            return $shoe_detail;
        });
    }

    public function soft_delete(int $id): void
    {
        $shoe_detail = ShoeDetail::findOrFail($id);
        $shoe_detail->update(['is_discontinued' => true]);
    }

    public function destroy(int $id): void
    {
        $shoe_detail = ShoeDetail::findOrFail($id);
        $shoe_detail->delete();
    }
}