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
        Schema::create('myorders', function (Blueprint $table) {
            $table->id();
            $table->string('userID');
            $table->string('productID');
            $table->string('price');
            $table->string('total_no_of_product');
            $table->enum('delivery_status',['Deliverd','Pending','Returned','Refunded','Out For Delivery'])->default('Pending');
            $table->string('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('myorders');
    }
};
