<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagens extends Model
{
    use HasFactory;

    public function chamado()
    {
        return $this->belongsTo(Chamados::class, 'chamado_id', 'id');
    }

    public function remetente()
    {
        return $this->belongsTo(User::class, 'remetente_id', 'id');
    }
}
