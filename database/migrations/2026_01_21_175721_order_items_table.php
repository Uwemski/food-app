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
        //
        Schema::create('orderItems', function(Blueprint $table){
            $table->id();
            $table->foreignId('product_id')->constrained()->cascade();
            $table->integer('quantity');
            $table->decimal('price', 10,2);
            $table->decimal('subTotal', 10,2);
            $table->foreignId('order_id')->constrained()->cascade();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
