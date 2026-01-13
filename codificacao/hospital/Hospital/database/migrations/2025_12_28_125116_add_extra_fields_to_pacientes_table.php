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
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('cartao_sus')->nullable();
            $table->string('naturalidade')->nullable();
            $table->enum('estado_civil', ['Solteiro', 'Casado', 'Divorciado', 'Viúvo', 'Outros'])->nullable();
            $table->string('profissao')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->enum('raca_cor', ['Branco', 'Preto', 'Pardo', 'Amarelo', 'Indígena'])->nullable();
            $table->string('nome_mae')->nullable();
            $table->string('nome_pai')->nullable();
            $table->enum('escolaridade', ['Analfabeto','Fundamental','Médio','Superior'])->nullable();
            $table->boolean('regulado')->default(false);
            $table->string('cidade_atual')->nullable();
            $table->string('estado')->nullable();
            $table->string('rua')->nullable();
            $table->string('bairro')->nullable();
            $table->string('numero_casa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            //
        });
    }
};
