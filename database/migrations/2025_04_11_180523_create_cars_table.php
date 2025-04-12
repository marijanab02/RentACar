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
        Schema::create('cars', function (Blueprint $table) {
            $table->id('CAR_ID');
            $table->string('CAR_NAME');
            $table->string('FUEL_TYPE');
            $table->integer('CAPACITY');
            $table->integer('PRICE');
            $table->string('CAR_IMG');
            $table->string('AVAILABLE')->default('Y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
