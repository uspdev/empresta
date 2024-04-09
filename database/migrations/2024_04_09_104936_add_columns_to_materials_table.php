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
        Schema::table('materials', function (Blueprint $table) {
            $table->tinyInteger('devolucao')->default(0);
            $table->integer('prazo')->nullable();
            $table->tinyInteger('dias_da_semana')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn('devolucao');
            $table->dropColumn('prazo');
            $table->dropColumn('dias_da_semana');
        });
    }
};
