<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function getTags($id): JsonResponse
    {
        $post = Post::with('tags')->findOrFail($id);

        return response()->json([
            'post' => $post,
        ]);
    }
    public function addTags(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $post = Post::findOrFail($id);
        $post->tags()->sync($validated['tags']); // Añade o sincroniza los tags

        return response()->json([
            'message' => 'Tags asociados al post correctamente.',
        ]);
    }
}
