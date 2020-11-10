<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCupomDesconto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupom_desconto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('localizador');
            $table->decimal('desconto' ,6 ,2);
            $table->enum('modo_desconto', ['valor', 'porc'])->default('porc');
            $table->decimal('limite', 6,2);
            $table->enum('modo_limite', ['valor', 'qtd']);
            $table->dateTime('dth_validade');
            $table->enum('ativo', ['S', 'N']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cupom_desconto');
    }
}
