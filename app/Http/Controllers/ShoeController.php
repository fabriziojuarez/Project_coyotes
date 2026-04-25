<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShoeRequest;
use App\Http\Requests\UpdateShoeRequest;
use App\Services\ShoeService;

class ShoeController extends Controller
{
    public function __construct(protected ShoeService $shoeService)
    {
    }

    public function index(){
        $shoes = $this->shoeService->index();

        return response()->json([
            'message' => 'Zapatillas listadas',
            'data' => $shoes,
        ], 200);
    }
        
    public function show(int $id){
        $shoe = $this->shoeService->show($id);

        return response()->json([
            'message' => 'Zapatilla encontrada',
            'data' => $shoe,
        ], 200);
    }

    public function store(StoreShoeRequest $request){
        $shoe = $this->shoeService->store($request->validated());

        return response()->json([
            'message' => 'Zapatilla creada',
            'data' => $shoe,
        ], 201);

    }

    public function update(UpdateShoeRequest $request, int $id){
        $shoe = $this->shoeService->update($id, $request->validated());

        return response()->json([
            'message' => 'Zapatilla actualizada',
            'data' => $shoe,
        ], 200);
    }

    public function delete(int $id){
        $this->shoeService->soft_delete($id);

        return response()->json([
            'message' => 'Zapatilla eliminada',
        ], 200);
    }

    public function destroy(int $id){
        $this->shoeService->destroy($id);

        return response()->json([
            'message' => 'Zapatilla eliminada permanentemente',
        ], 200);
    }

}