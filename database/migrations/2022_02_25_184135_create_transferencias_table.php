<?php

use App\Models\Chamados;
use App\Models\Setores;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferencias', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Setores::class, 'setor_origem');
            $table->foreignIdFor(Setores::class, 'setor_destino');
            $table->foreignIdFor(Chamados::class, 'chamado_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transferencias');
    }
}
