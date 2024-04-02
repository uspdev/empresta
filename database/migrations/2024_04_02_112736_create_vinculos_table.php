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
        Schema::create('vinculos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });

        $permissoesVinculo = [
            'Aluno Convênoi Interc Grad' => 'Alunoconvenioint',
            'Aluno de Cultura e Extensão' => 'Alunoceu',
            'Aluno de Graduação' => 'Alunogr',
            'Aluno de Pós-Graduação' => 'Alunopos',
            'Aluno Escola de Arte Dramática' => 'Alunoead',
            'Docente' => 'Docente',
            'Docente Aposentado' => 'Servidor',
            'Estagiário' => 'Estagiario',
            'Pós-doutorando' => 'Alunopd',
            'Servidor' => 'Servidor',
        ];

        foreach($permissoesVinculo as $nome => $permission){
            \App\Models\Vinculo::create([
                'nome' => $nome
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vinculos');
    }
};
