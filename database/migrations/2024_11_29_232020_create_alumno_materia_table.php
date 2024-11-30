<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumno_materia', function (Blueprint $table) {
            $table->id();
            $table->foreignId("estudiante_id")->nullable()->constrained("estudiantes")->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId("materia_id")->nullable()->constrained("materias")->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno_materia');
    }
};
