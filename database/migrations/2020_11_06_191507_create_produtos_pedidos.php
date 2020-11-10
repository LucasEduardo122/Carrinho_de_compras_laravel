<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosPedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('produto_id');
            $table->enum('status', ['RE', 'PA', 'CA']);
            $table->decimal('valor', 6,2)->default(0);;
            $table->decimal('desconto', 6,2)->default(0);;
            $table->unsignedBigInteger('cupom_desconto_id')->nullable();
            $table->timestamps();

            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('cupom_deconto_id')->references('id')->on('cupom_desconto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos_pedidos');
    }
}
