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
        Schema::create('objetos_pedidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned(); 
            $table->bigInteger('order_id')->unsigned();
            $table->decimal('price');
            $table->integer('quantity');
            $table->timestamps ();
            $table->foreign('product_id')->references ('id')->on('products')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('pedidos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objetos_pedidos');
    }
};
