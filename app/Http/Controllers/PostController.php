<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($id): JsonResponse
    {
        $post = Post::with('comments')->findOrFail($id);

        return response()->json([
            'post' => $post
        ]);
    }
    public function addComment(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'body' => 'required|string|max:255',
        ]);

        $post = Post::findOrFail($id);

        $comment = $post->comments()->create([
            'body' => $validated['body'],
        ]);

        return response()->json([
            'message' => 'Comentario agregado exitosamente.',
            'comment' => $comment,
        ], 201);
    }
}
