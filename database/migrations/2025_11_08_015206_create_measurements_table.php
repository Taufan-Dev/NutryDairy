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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children')->onDelete('cascade');
            $table->date('measured_at');
            $table->float('weight_kg')->nullable();
            $table->float('height_cm')->nullable();
            $table->float('zscore_bb_u')->nullable();
            $table->string('bb_u_status')->nullable();
            $table->float('zscore_tb_u')->nullable();
            $table->string('tb_u_status')->nullable();
            $table->float('zscore_bb_tb')->nullable();
            $table->string('bb_tb_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
