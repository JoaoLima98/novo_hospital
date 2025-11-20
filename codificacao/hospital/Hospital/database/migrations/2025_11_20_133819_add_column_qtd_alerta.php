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
        Schema::table('remedios', function (Blueprint $table) {
            $table->integer('qtd_alerta')->nullable()->default(10)->after('nome');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('remedios', function (Blueprint $table) {
            $table->dropColumn('qtd_alerta');
        });
    }
};
