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
            $table->decimal('L'); // Lambda
            $table->decimal('M'); // Median
            $table->decimal('S'); // Coefficient of variation
            $table->decimal('SD4neg')->nullable();
            $table->decimal('SD3neg')->nullable();
            $table->decimal('SD2neg')->nullable();
            $table->decimal('SD1neg')->nullable();
            $table->decimal('SD0')->nullable();
            $table->decimal('SD1')->nullable();
            $table->decimal('SD2')->nullable();
            $table->decimal('SD3')->nullable();
            $table->decimal('SD4')->nullable();
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
