<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamados extends Model
{
    use HasFactory;

    public function solicitante()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function localizacao()
    {
        return $this->belongsTo(Localizacao::class);
    }
    
    public function mensagens()
    {
        return $this->hasMany(Mensagens::class, 'chamado_id', 'id');
    }

    public function anexos()
    {
        return $this->hasMany(Anexos::class);
    }

    public function setor()
    {
        return $this->belongsTo(Setores::class);
    }
}
