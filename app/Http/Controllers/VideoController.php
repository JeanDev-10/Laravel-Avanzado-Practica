<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function addTags(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $video = Video::findOrFail($id);
        $video->tags()->sync($validated['tags']); // Añade o sincroniza los tags

        return response()->json([
            'message' => 'Tags asociados al video correctamente.',
            'tags' => $video->tags,
        ]);
    }
    public function getTags($id): JsonResponse
    {
        $video = Video::with('tags')->findOrFail($id);

        return response()->json([
            'video' => $video,
        ]);
    }
}
