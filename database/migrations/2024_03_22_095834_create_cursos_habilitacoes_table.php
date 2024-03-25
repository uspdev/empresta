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
        Schema::create('cursos_habilitacoes', function (Blueprint $table) {
            $table->id();
            $table->integer('codcur');
            $table->string('nomcur');
            $table->integer('codhab');
            $table->string('nomhab');
            $table->string('perhab');
            $table->foreignId('departamento_id')->constrained(table: 'departamentos_de_ensino')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos_habilitacoes');
    }
};
