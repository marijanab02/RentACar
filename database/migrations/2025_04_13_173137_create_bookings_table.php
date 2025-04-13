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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('car_id');
            $table->string('email');
            $table->string('book_place');
            $table->date('book_date');
            $table->integer('duration');
            $table->string('phone_num');
            $table->string('destination');
            $table->date('return_date');
            $table->integer('price');
            $table->string('book_status');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
