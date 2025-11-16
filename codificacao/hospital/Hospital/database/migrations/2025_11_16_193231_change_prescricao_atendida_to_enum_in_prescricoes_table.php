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
        Schema::table('prescricoes', function (Blueprint $table) {
            $table->enum('prescricao_atendida', [
                'atendido', 
                'nao_atendido', 
                'atendido_parcialmente'
            ])
            ->default('nao_atendido') 
            ->change(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescricoes', function (Blueprint $table) {
            $table->boolean('prescricao_atendida')->default(false)->change();
        });
    }
};
