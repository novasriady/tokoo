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
            $table->increments('product_id'); // Mengubah tipe data menjadi 'increments'
            $table->unsignedInteger('product_category_id')->nullable(true); // Mengubah tipe data menjadi 'unsignedInteger'
            $table->string('product_name',100);
            $table->string('product_description',100);
            $table->integer('product_price');
            $table->integer('product_stock');
            $table->string('product_img');
            $table->timestamps();

            // Merujuk kolom 'product_category_id' ke 'category_id' pada tabel 'categories'
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

