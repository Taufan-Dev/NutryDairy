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
        Schema::create('nutrition_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('measurement_id')->unique()->constrained('measurements')->onDelete('cascade');
            $table->string('bb_u_status', 10)->nullable();
            $table->string('bb_tb_status', 10)->nullable();
            $table->string('tb_u_status', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition_status');
    }
};
