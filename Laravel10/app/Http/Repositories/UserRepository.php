<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class UserRepository {
    

    public function getAll()
    {
        return User::with('roles')->orderBy('id')->get();
    }


    public function findByEmail(string $email): ?user
    {
        return User::where('email', $email)->first();
    }


    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'sur_name' => $request->sur_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'model_type' => 'App\Models\User',
        ]);

        return $user;
    }


    public function login()
    {     
        $lastLogin = Carbon::now();
        $user =Auth::user();
        $user->update(['last_login' => $lastLogin]);
    }

}

