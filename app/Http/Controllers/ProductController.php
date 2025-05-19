<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->productService->showProduct();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try{
            db::beginTransaction();
            $this->productService->createProduct($request->validated());
            db::commit();
            return  response()->json('Producto creado',200); 

        }catch(Exception $exception){
            db::rollBack();
            return response()->json('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($product)
    {
        return response()->json(data: $this->productService->showProduct($product));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $product)
    {
        try{
            db::beginTransaction();
            $response = $this->productService->updateproduct($request->validated(), $product);
            db::commit();
            return response()->json(['mensaje' =>$response->getData(true)['mensaje'],
            'status'=>$response->getData(true)['status']]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['mensaje' =>$e->getMessage(),'status'=>false],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            return $this->productService->deleteProduct( $id);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['mensaje'=> $e->getMessage()],500);
        }
    }
}
