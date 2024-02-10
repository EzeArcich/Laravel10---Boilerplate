<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\JwtRepository;
use Tymon\JWTAuth\Facades\JWTAuth;
use Spatie\Permission\Models\Role;

class ServicesUser {

    public function __construct(UserRepository $userRepository, JwtRepository $jwtRepository) {

        $this->userRepository = $userRepository;
        $this->jwtRepository = $jwtRepository;

    }
    
    public function index()
    {
        $users = $this->userRepository->getAll();

        $usersData = $users->map(function ($userData) {
            return [
                'id' => $userData->id,
                'name' => $userData->sur_name ? $userData->name . ' ' . $userData->sur_name : $userData->name,
                'email' => $userData->email,
                'enabled' => $userData->enabled ? 'si' : 'no',
                'rol' => $userData->roles->isNotEmpty() ? $userData->roles->first()->name : null,
                'last_login' => $userData->last_login ? $userData->last_login : null,
            ];
        });

        return response()->json([
            'error' => false,
            'message' => 'Listado con éxito',
            'data' => $usersData
        ], 200);
        
    }

    public function show(string $email)
    {
        $foundUser = $this->userRepository->findByEmail($email); 
        
        return response()->json([
            'error' => false,
            'message' => 'Usuario encontrado con éxito',
            'data' => $foundUser
        ], 200);
 
    }

    public function register(Request $request)
    {
        $foundUser = $this->userRepository->register($request);

        $roleId = $request->role_id;
        $role = Role::findById($roleId);

        if($role) {
            $foundUser->assignRole($role);
            $token = JWTAuth::fromUser($foundUser);   
            $response = response()->json([
                'user' => $foundUser,
                'token' => $token
            ], 201);
        } else {
            $response = response()->json([
                'error' => 'Role not found'
            ], 404);
        }

        return $response;
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        $newToken = $this->jwtRepository->creationToken($credentials);

        $loginUser = $this->userRepository->login($request);




        return response()->json(compact('newToken'));

    }
}

