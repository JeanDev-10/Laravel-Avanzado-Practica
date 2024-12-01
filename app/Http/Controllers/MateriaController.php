<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $user=Estudiante::create([
                'name'=>"pierre",
            ]);
            $user->materias()->attach([5]);
            DB::commit();
            return response()->json(['message' => 'usuario y materia creados para probar correctamente.']);
        }catch(Exception $e){
            DB::rollback();
            return response()->json(['error' => 'Ocurrió un error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Materia $materia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materia $materia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materia $materia)
    {
        //
    }
}
