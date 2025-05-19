<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
       public function showCategory($id = null)
    {
        if(!is_null($id)){
            $exist = Category::find($id);
            if(!$exist){
                return response()->json(['mensaje'=> 'No existe la categoria con id: '.$id, 'status' =>false]);
            }
            return response()->json(['data'=> $exist, 'status' =>true]);

        } 
        return response()->json(['data'=> Category::all(), 'status' =>true]);

    }

    public function createCategory(array $category){
        return Category::create($category);
    }

    public function updateCategory(array $category, $id){
         $exist = Category::find($id);
        if(!$exist){
            return response()->json(['mensaje'=> 'No existe una Categoria con id: '.$id, 'status' =>false]);
        }
        Category::where('id',$id)->update($category);
        return response()->json(['mensaje'=> 'Categoria Actualizada', 'status' =>true]);  
    }

    public function deleteCategory($id){

        $exist = Category::find($id);
        if(!$exist){
            return response()->json(['mensaje'=> 'No existe la categoria con id: '.$id, 'status' =>false]);
        }
        Category::where('id',$id)->delete();
        return response()->json(['mensaje'=> 'Categoria Eliminada', 'status' =>true]);
    }
}
