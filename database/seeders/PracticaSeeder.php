<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use App\Models\Materia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PracticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Crear un usuario
        $user = Estudiante::create([
            'name' => 'John Doe',
        ]);

        // Crear materias
        $materia_1 = Materia::create(['name' => 'Base de datos']);
        $materia_2 = Materia::create(['name' => 'Programación 1']);
        $materia_3 = Materia::create(['name' => 'Programación 2']);
        $materia_4 = Materia::create(['name' => 'Programación 3']);

        // Asignar materias al estudiante
        $user->materias()->attach([$materia_1->id, $materia_2->id,$materia_3->id,$materia_4->id]);
        // eliminar materia al estudiante
        $user->materias()->detach($materia_4->id);
        // Sincronizar materias (reemplaza los existentes):
        $user->materias()->sync([$materia_1->id]);
    }
}
