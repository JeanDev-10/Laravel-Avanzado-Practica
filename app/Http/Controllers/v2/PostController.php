<?php

namespace App\Http\Controllers\v2;

use App\DTOs\PostDTO;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Responses\ApiResponses;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->get();
        return ApiResponses::succes("Lista de posts Encontrado", 200, PostResource::collection($posts));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // 1. Validar y crear un DTO
        $postDTO = $request->toDTO();

        // 2. Usar el DTO para crear un modelo
        $post = Post::create([
            'title' => $postDTO->title,
            'content' => $postDTO->content,
            'user_id' => $postDTO->user_id,
        ]);

        // 3. Retornar el Resource
        return ApiResponses::succes("Post creado correctamente", 200, new PostResource($post));
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $post = Post::with('user')->findOrFail(decrypt($id));
        return ApiResponses::succes("Post Encontrado", 200, new PostResource($post));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
