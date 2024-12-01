<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show($id)
    {
        $video = Video::with('comments')->findOrFail($id);

        return response()->json([
            'video' => $video,
        ]);
    }
    public function addComment(Request $request, $id)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:255',
        ]);

        $video = Video::findOrFail($id);

        $comment = $video->comments()->create([
            'body' => $validated['body'],
        ]);

        return response()->json([
            'message' => 'Comentario agregado exitosamente.',
            'comment' => $comment,
        ], 201);
    }
}
