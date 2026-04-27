<?php

namespace App\Http\Controllers;
use App\Services\ShoeDetailService;
use App\Http\Requests\UpdateShoeDetailRequest;

class ShoeDetailController extends Controller
{
    public function __construct(
        protected ShoeDetailService $shoeDetailService
    )
    {}
    
    public function index(){
        $shoe_details = $this->shoeDetailService->index();

        return response()->json([
            'message' => 'Modelos de zapatos con stock listados',
            'data' => $shoe_details,
        ], 200);
    }

    public function show(int $id){
        $shoe_detail = $this->shoeDetailService->show($id);

        return response()->json([
            'message' => 'Modelo de zapato encontrado',
            'data' => $shoe_detail,
        ], 200);
    }

    public function getShoes(int $id){
        $shoes = $this->shoeDetailService->getShoes($id);

        return response()->json([
            'message' => 'Zapatos del modelo encontrados',
            'data' => $shoes,
        ], 200);
    }

    public function update(UpdateShoeDetailRequest $request, int $id){
        $shoe_detail = $this->shoeDetailService->update($id, $request->validated());

        return response()->json([
            'message' => 'Modelo de zapato actualizado',
            'data' => $shoe_detail,
        ], 200);
    }

    public function delete(int $id){
        $this->shoeDetailService->soft_delete($id);

        return response()->json([
            'message' => 'Modelo de zapato eliminado',
        ], 200);
    }

    public function destroy(int $id){
        $this->shoeDetailService->destroy($id);

        return response()->json([
            'message' => 'Modelo de zapato eliminado permanentemente',
        ], 200);
    }
}
