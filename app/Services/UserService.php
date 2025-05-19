<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function createUser( array $user){
        $new_user = User::create($user);
        $rol = $user['rol'] ?? 'user';
        if(Auth::user()->hasRole('admin')){
            $new_user->assignRole($rol);
        }else{
            $new_user->assignRole('user');
        }
        return true;
    }
}
