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
        Schema::create('cartsession', function (Blueprint $table) {
            $table->id('cartsession_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customers');
            $table->string('product_ids');
            $table->string('image');
            $table->string('name');
            $table->integer('price');
            $table->integer('discount_price');
            $table->integer('quantity');
            // $table->integer('total_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartsession');
    }
};
