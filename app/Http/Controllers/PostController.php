<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::with('image')->get();
    }

    public function store(Request $request)
    {
        $post = Post::create($request->only('name'));
        $post->image()->create($request->only('url'));

        return response()->json($post->load('image'), 201);
    }

    public function show(Post $post)
    {
        return $post->load('image');
    }
}
