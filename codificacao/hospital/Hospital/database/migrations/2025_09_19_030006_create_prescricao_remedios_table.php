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
        Schema::create('prescricao_remedios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_prescricao')->constrained('prescricoes')->onDelete('cascade');
            $table->foreignId('id_remedio')->constrained('remedios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescricao_remedios');
    }
};
