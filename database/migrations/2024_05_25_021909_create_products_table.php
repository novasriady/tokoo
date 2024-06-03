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
            $table->uuid('product_id')->primary();
            $table->uuid('product_category_id')->nullable(true);
            $table->string('product_name');
            $table->string('product_description');
            $table->integer('product_price');
            $table->integer('product_stock');
            $table->string('product_img');
            $table->timestamps();

            $table->foreign('product_category_id')->references('category_id')->on('categories')->onDelete('set null')->onUpdate('cascade');
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
