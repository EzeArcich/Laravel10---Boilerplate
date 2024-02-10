<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Repositories\JwtRepository;
use Tymon\JWTAuth\Facades\JWTAuth;
use Spatie\Permission\Models\Role;

class ServicesJwt {

    public function __construct(JwtRepository $jwtRepository) {

        $this->jwtRepository = $jwtRepository;
    }
    

    public function creationToken(string $email)
    {
        $jwtNew = $this->jwtRepository->creationToken($email); 

        try {
            if(!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'invalid credentials'
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'not create token',
                'message' => $e->getMessage(),
            ], 500);
        }
        
        return $jwtNew;
 
    }




}

