<?php

namespace App\Http\Controllers\v1;

use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\ApiResponses;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $users = $this->userRepository->index();
        return ApiResponses::succes("Lista de usuarios", 200, UserResource::collection($users));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user=new User($request->all());
        $user = $this->userRepository->save($user);

        return ApiResponses::succes("Se ha creado correctamente!", 201, new UserResource($user));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userRepository->show(decrypt($id));
        return ApiResponses::succes("Usuario Encontrado", 200, new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = $this->userRepository->show(decrypt($id));
        $user->fill($request->all());
        $user_updated = $this->userRepository->save($user);
        return ApiResponses::succes("Usuario actualizado", 200, new UserResource($user_updated));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userRepository->show(decrypt($id));
        $user_deleted = $this->userRepository->destroy(decrypt($id));
        return ApiResponses::succes("Usuario eliminado", 200, new UserResource($user_deleted));
    }
}
