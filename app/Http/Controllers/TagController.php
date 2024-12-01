<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($id): JsonResponse
    {
        $tag = Tag::with(['posts', 'videos'])->findOrFail($id);

        return response()->json([
            'tag' => $tag,
        ]);
    }
}
