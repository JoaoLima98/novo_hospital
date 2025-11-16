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
            $table->boolean('atendido')->default(false)->after('duracao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prescricao_remedios', function (Blueprint $table) {
            $table->dropColumn('atendido');
        });
    }
};
