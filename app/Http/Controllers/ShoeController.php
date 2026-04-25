<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShoeRequest;
use App\Http\Requests\UpdateShoeRequest;
use App\Services\ShoeService;
use Illuminate\Session\Store;

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

    }

    public function store(StoreShoeRequest $request){
        $shoe = $this->shoeService->store($request->validated());

        return response()->json([
            'message' => 'Zapatilla creada',
            'data' => $shoe,
        ], 201);

    }

    public function update(){

    }

    public function delete(){

    }
}
