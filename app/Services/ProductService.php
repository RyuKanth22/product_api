<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{

    public function showProduct($id = null)
    {
    if(!is_null($id)){
        $exist = Product::find($id);
        if(!$exist){
            return response()->json(['mensaje'=> 'No existe el producto con id: '.$id, 'status' =>false]);
        }
        return response()->json(['data'=> $exist, 'status' =>true]);

    } 
        return response()->json(['data'=> Product::paginate(5), 'status' =>true]);

    }

    public function createProduct(array $product){
        return Product::create($product);
    }

    public function deleteProduct($id){

        $exist = Product::find($id);
        if(!$exist){
            return response()->json(['mensaje'=> 'No existe un producto con id: '.$id, 'status' =>false]);
        }
        Product::where('id',$id)->delete();
        return response()->json(['mensaje'=> 'Producto Eliminado', 'status' =>true]);
    }

    public function updateProduct(array $data, $product_id){
        $exist = Product::find($product_id);
        if(!$exist){
            return response()->json(['mensaje'=> 'No existe un producto con id: '.$product_id, 'status' =>false]);
        }
        Product::where('id',$product_id)->update($data);
        return response()->json(['mensaje'=> 'Producto Actualizado', 'status' =>true]);
    }
}
