<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return json_encode([
            'error' => false,
            'message' => 'Listado con éxito',
            'data' => []
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);




        return response()->json([
            'error' => false,
            'message' => 'Almacenado con éxito',
            'data' => ['id' => $user->id]
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return json_encode([
            'error' => false,
            'message' => 'Objeto encontrado',
            'data' => []
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return json_encode([
            'error' => false,
            'message' => 'Actualizado con éxito',
            'data' => []
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return json_encode([
            'error' => false,
            'message' => 'Elminado con éxito',
            'data' => []
        ], 200);
    }
}
