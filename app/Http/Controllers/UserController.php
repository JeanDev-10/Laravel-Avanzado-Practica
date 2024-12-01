<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::with('image')->get();
    }

    public function store(Request $request)
    {
        $user = User::create($request->only('name'));
        $user->image()->create($request->only('url'));

        return response()->json($user->load('image'), 201);
    }

    public function show(User $user)
    {
        return $user->load('image');
    }
}
