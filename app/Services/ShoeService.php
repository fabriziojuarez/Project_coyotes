<?php

namespace App\Services;

use App\Models\Shoe;
use App\Models\ShoeDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

use App\Services\ShoeDetailService;

class ShoeService
{
    public function index(): Collection
    {
        $shoes = Shoe::with('shoeDetail')
            ->whereHas('shoeDetail', function($query){
                $query->where('is_discontinued', false);
            })
            ->where('stock', '>', 0)
            ->where('is_hidden', false)
            ->get(); 
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
            $shoe_detail_service = new ShoeDetailService();
            $shoe_detail = $shoe_detail_service->store($data);

            $duplicate_fields = Shoe::select('*')
                ->where('shoe_detail_id', $shoe_detail->id)
                ->where('size', $data['size'])
                ->where('color', $data['color'])
                ->first();
            $sku_exists = Shoe::where('sku', $data['sku'])->exists();

            // si ingreso un sku ya existente pero esta en hidden, puedo actualizarlo y is_hidden=false
            if ($duplicate_fields) {
                throw new \InvalidArgumentException('Datos ya registrados en el SKU: ' . $duplicate_fields->sku);
            }

            if($sku_exists) {
                $shoe_hidden = Shoe::where('sku', $data['sku'])->first();
                if($shoe_hidden->is_hidden){
                    $shoe_hidden->update([
                        'shoe_detail_id' => $shoe_detail->id,
                        'color' => $data['color'],
                        'size' => $data['size'],
                        'stock' => $data['stock'],
                        'is_hidden' => false,
                    ]);

                    $shoe_hidden->refresh();
                    return $shoe_hidden;

                }else{
                    throw new \InvalidArgumentException('SKU ya registrado, revise los datos ingresados');
                }
            }

            $shoe = Shoe::create([
                'sku' => $data['sku'],
                'shoe_detail_id' => $shoe_detail->id,
                'color' => $data['color'],
                'size' => $data['size'],
                'stock' => $data['stock'],
                'is_hidden' => false,
            ]);

            $shoe->refresh();
            return $shoe;
        });
    }

    public function update(int $id, array $data): Shoe
    {
        $shoe = Shoe::findOrFail($id);

        return DB::transaction(function() use ($shoe, $data){
            $shoe->update([
                'stock' => $data['stock'],
            ]);

            $shoe->refresh();
            return $shoe;
        });
    }

    public function soft_delete(int $id): void
    {
        $shoe = Shoe::findOrFail($id);
        $shoe->update(['is_hidden' => true]);
    }

    public function destroy(int $id): void
    {
        $shoe = Shoe::findOrFail($id);
        $shoe->delete();
    }
}