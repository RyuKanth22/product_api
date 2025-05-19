<?php

// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try{
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'mensaje'=> 'Usuario Autenticado' ,
            'token' => $token
        ]);
    }catch(Exception $e){
        return response()->json($e->getMessage(),500);
    }
    }

public function logout(Request $request)
{
    try {
        $user = $request->user();
        if (!$user) {
            return response()->json(['mensjae' => 'No hay usuario autenticado'], 401);
        }
        $user->currentAccessToken()->delete();
        return response()->json(['mensaje' => 'Sesión cerrada']);
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
