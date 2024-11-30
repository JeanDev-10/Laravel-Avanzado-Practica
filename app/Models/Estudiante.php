<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['name'];
    public function materias(){
       return $this->belongsToMany(Materia::class,'alumno_materia');
    }
}
