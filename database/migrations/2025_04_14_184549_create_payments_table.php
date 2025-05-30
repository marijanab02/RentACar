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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('PAY_ID');
            $table->unsignedBigInteger('BOOK_ID');
            $table->string('CARD_NO');
            $table->string('EXP_DATE');
            $table->integer('CVV');
            $table->integer('PRICE'); 
            $table->timestamps();

            $table->foreign('BOOK_ID')
                  ->references('BOOK_ID')
                  ->on('bookings')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
