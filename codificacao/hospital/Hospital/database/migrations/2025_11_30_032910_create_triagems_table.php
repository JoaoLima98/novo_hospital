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
        Schema::create('triagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes'); // Assumindo tabela pacientes
            $table->foreignId('enfermeiro_id')->constrained('users');   // Quem fez a triagem

            // Sinais Vitais (Obrigatórios conforme 4.1)
            $table->integer('pressao_sistolica');  // Ex: 120
            $table->integer('pressao_diastolica'); // Ex: 80
            $table->decimal('temperatura', 4, 1);
            $table->integer('frequencia_cardiaca');
            $table->string('spo2'); // Armazena a string da faixa ou enum
            $table->string('glicemia'); // Armazena a string da faixa ou enum

            // Escalas e Avaliações
            $table->string('manchester_classificacao'); // Emergência, Muito Urgente...
            $table->integer('glasgow'); // 3 a 15
            $table->integer('escore_dor')->nullable(); // 0 a 10 (Opcional no spec)

            // Medidas Antropométricas (Opcionais no spec)
            $table->decimal('peso', 5, 2)->nullable();
            $table->integer('altura_cm')->nullable();

            // Descrições (Opcionais)
            $table->text('queixa_principal')->nullable();
            $table->text('alergias')->nullable();
            $table->text('medicacao_uso')->nullable();
            
            // Sintomas (Multipla escolha - salvaremos como JSON)
            $table->json('sintomas_gripais')->nullable();

            // Chegada e Acidentes
            $table->string('tipo_chegada'); // SAMU, Polícia, etc.
            $table->boolean('acidente_trabalho')->default(false);
            $table->boolean('acidente_veiculo')->default(false);
            $table->string('tipo_envolvimento_veiculo')->nullable(); // Condutor, Passageiro...
            $table->boolean('atendido')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triagems');
    }
};
