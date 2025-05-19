<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
     protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
     public function store(StoreUserRequest $request)
    {
        try{
            DB::beginTransaction();
            $this->userService->createUser($request->validated());
            DB::commit();
            return response()->json(['message' => 'Usuario registrado exitosamente'], 201);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['error'=>$e->getMessage()],500);
        }
    }
}
