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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('category');
            $table->unsignedBigInteger('subcategory_id');
            $table->foreign('subcategory_id')->references('subcategory_id')->on('subcategory');
            $table->string('name',255);
            $table->string('description',500);
            $table->integer('price');
            $table->string('image',255);
            $table->string('img1',255);
            $table->string('img2',255);
            $table->string('img3',255);
            $table->string('img4',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
