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
        Schema::table('prescricao_remedios', function (Blueprint $table) {
            $table->double('quantidade' ,5 ,1)->nullable();
            $table->string('unidade_medida')->nullable();
            $table->double('intervalo', 5, 1)->nullable();
            $table->double('duracao', 5, 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescricao_remedios', function (Blueprint $table) {
            $table->dropColumn('quantidade');
            $table->dropColumn('unidade_medida');
            $table->dropColumn('intervalo');
            $table->dropColumn('duracao');
        });
    }
};
