<?php

use App\Enums\StatusTipo;
use App\Models\Subcategoria;
use App\Models\User;
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
            $table->foreignId('solicitante_id')->references('id')->on('users')->constrained('users');
            $table->foreignId('subcategoria_id')->references('id')->on('subcategorias')->constrained('subcategorias');
            $table->string('solicitante');
            $table->string('email');
            $table->string('telefone')->nullable(true);
            $table->string('solicitacao');
            $table->string('status')->default(StatusTipo::ABERTO);
            $table->tinyInteger('respondido')->default(0);
            $table->tinyInteger('transferido')->default(0);
            $table->foreignId('responsavel_id')->nullable(true)->references('id')->on('users')->constrained('users');
            $table->timestamps();
            $table->dateTime('data_conclusao')->nullable();
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
