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
            $table->dateTime('data_emprestimo');
            $table->dateTime('data_devolucao')->nullable();
            $table->string('username')->nullable();
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
