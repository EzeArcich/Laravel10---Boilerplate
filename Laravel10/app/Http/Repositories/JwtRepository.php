<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;

class JwtRepository {
    

    public function creationToken($credentials)
    {
        return JWTAuth::attempt($credentials);
    }


    public function findByEmail(string $email): ?user
    {
        return User::where('email', $email)->first();
    }


}

