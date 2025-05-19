<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Exception;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
     protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
     return response()->json($this->categoryService->showCategory()); 
    //  dd($d);  
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
    public function store(StoreCategoryRequest $request)
    {
        try{
            DB::beginTransaction();
                $this->categoryService->createCategory($request->validated());
            DB::commit();
            return response()->json(['mensaje'=> 'Categoria Creada']);

        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['mensaje'=> $e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($category)
    {
        return response()->json(data: $this->categoryService->showCategory($category));   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $category)
    {
       try{
            DB::beginTransaction();
              $response = $this->categoryService->updateCategory($request->validated(), $category);
            DB::commit();
            return response()->json(['mensaje' =>$response->getData(true)['mensaje'],
            'status'=>$response->getData(true)['status']]);

        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['mensaje'=> $e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            return $this->categoryService->deleteCategory( $id);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['mensaje'=> $e->getMessage()],500);
        }
    }
}
