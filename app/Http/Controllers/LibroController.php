<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "message"=>"ver libros"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        return response()->json([
            "message"=>"crear libro"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {

        return response()->json([
            "message"=>"ver un libro"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {

        return response()->json([
            "message"=>"editar libro"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {

        return response()->json([
            "message"=>"eliminar libro"
        ]);
    }
}
