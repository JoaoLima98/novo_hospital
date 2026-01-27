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
        Schema::table('triagens', function (Blueprint $table) {
            $table->enum('status', [
                'aguardando_atendimento',  
                'em_atendimento',          
                'aguardando_medicamentos', 
                'finalizado',              
                'cancelado'                
            ])
            ->default('aguardando_atendimento') 
            ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('triagens', function (Blueprint $table) {
            //
        });
    }
};
