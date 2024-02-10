<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ServicesUser;

class UserController extends Controller
{
    protected ServicesUser $ServicesUser;

    public function __construct(ServicesUser $ServicesUser) {

        $this->ServicesUser = $ServicesUser;
    }

    public function index(Request $request)
    {

        return $this->ServicesUser->index();

    }

    public function show(Request $request)
    {

        $email = $request->email;

        return $this->ServicesUser->show($email);

    }
}
