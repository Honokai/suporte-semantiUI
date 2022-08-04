<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    use HasFactory;

    public function setorOrigem()
    {
        return $this->belongsTo(Setores::class, 'setor_origem');
    }

    public function setorDestino()
    {
        return $this->belongsTo(Setores::class, 'setor_destino');
    }

    public function chamado()
    {
        return $this->belongsTo(Chamados::class, 'chamado_id');
    }
}
