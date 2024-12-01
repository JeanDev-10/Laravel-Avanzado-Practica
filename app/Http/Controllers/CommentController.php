<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('commentable')->get();

        return response()->json([
            'comments' => $comments,
        ]);
    }
    public function show($id)
    {
        $comment = Comment::with('commentable')->findOrFail($id);

        return response()->json([
            'comment' => $comment,
        ]);
    }
}
