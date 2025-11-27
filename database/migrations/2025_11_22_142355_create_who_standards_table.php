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
        Schema::create('who_standards', function (Blueprint $table) {
            $table->id();
            $table->enum('gender', ['laki-laki', 'perempuan'])->nullable();
            $table->integer('age_value')->nullable();
            $table->decimal('length_height_value')->nullable();
            $table->string('indicator')->nullable();
            $table->decimal('L', 10, 5); // Lambda
            $table->decimal('M', 10, 5); // Median
            $table->decimal('S', 10, 5); // Coefficient of variation
            $table->decimal('SD4neg', 10, 5)->nullable();
            $table->decimal('SD3neg', 10, 5)->nullable();
            $table->decimal('SD2neg', 10, 5)->nullable();
            $table->decimal('SD1neg', 10, 5)->nullable();
            $table->decimal('SD0', 10, 5)->nullable();
            $table->decimal('SD1', 10, 5)->nullable();
            $table->decimal('SD2', 10, 5)->nullable();
            $table->decimal('SD3', 10, 5)->nullable();
            $table->decimal('SD4', 10, 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('who_standars');
    }
};
