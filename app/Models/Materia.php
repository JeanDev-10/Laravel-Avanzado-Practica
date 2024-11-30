<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    public $timestamps=false;


    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class,'alumno_materia');
     }

}
