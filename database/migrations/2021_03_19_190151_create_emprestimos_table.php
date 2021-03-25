<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmprestimosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprestimos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('data_emprestimo');
            $table->date('data_devolucao')->nullable();
            $table->string('codpes')->nullable();
            $table->foreignId('visitante_id')->nullable()->constrained('visitantes');
            $table->foreignId('material_id')->nullable()->constrained('materials');
            $table->foreignId('created_by_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emprestimos');
    }
}
