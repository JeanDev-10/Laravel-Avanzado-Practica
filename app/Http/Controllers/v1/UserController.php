<?php

namespace App\Http\Controllers\v1;

use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\ApiResponses;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('posts')->get();
        return ApiResponses::succes("Lista de usuarios",200,UserResource::collection($users));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $userDTO = $request->toDTO();

        $user = User::create([
            'name' => $userDTO->name,
            'email' => $userDTO->email,
            'password' => $userDTO->password,
        ]);

        return ApiResponses::succes("Se ha creado correctamente!",201, new UserResource($user));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('posts')->findOrFail(decrypt($id));
        return ApiResponses::succes("Usuario Encontrado",200,new UserResource($user));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
