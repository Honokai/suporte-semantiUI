<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitante_id')->constrained('users')->nullable(false);
            $table->foreignId('categoria_id')->constrained('categorias')->nullable(false);
            $table->foreignId('setor_id')->constrained('setores')->nullable(false);
            $table->foreignId('localizacao_id')->constrained('localizacoes')->nullable(false);
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
        Schema::dropIfExists('chamados');
    }
}
