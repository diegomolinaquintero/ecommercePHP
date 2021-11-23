<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            // $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
            $table->integer('product_id');
            $table->integer('pedido_id');
            $table->integer('cantidad');
            $table->timestamps();
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos_productos');
    }
}
