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
        Schema::create('triagem_especialidade', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('triagem_id');
            $table->unsignedBigInteger('especialidade_id');
            $table->foreign('triagem_id')
                ->references('id')
                ->on('triagens')
                ->onDelete('cascade');
            $table->foreign('especialidade_id')
                ->references('id')
                ->on('especialidades')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triagem_especialidade');
    }
};
