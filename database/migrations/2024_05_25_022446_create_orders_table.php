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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('order_id')->primary();
            $table->uuid('order_user_id');
            $table->string('order_address')->nullable(true);
            $table->string('order_shippingservice')->nullable(true);
            $table->integer('order_shippingcost')->nullable(true);
            $table->integer('order_totalpayment')->nullable(true);
            $table->string('order_proofpayment')->nullable(true);
            $table->string('order_rejectednotes')->nullable(true);
            $table->enum('order_status', ['Unpaid', 'Pending Approval', 'Approved', 'Rejected', 'Retrieved', 'Sent'])->default('Unpaid')->nullable(true);
            $table->timestamps();

            $table->foreign('order_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
