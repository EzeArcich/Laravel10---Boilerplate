<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Services\ServicesUser;

class AuthController extends Controller
{
    protected ServicesUser $userRepository;


    public function __construct(ServicesUser $ServicesUser) {

        $this->ServicesUser = $ServicesUser;
    }


    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required:max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        return $this->ServicesUser->register($request);

    }


    public function login(LoginRequest $request)
    {

        return $this->ServicesUser->login($request);

    }

}
