<?php

namespace App\Models;

use App\Traits\HasAnexo;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamados extends Model
{
    use HasFactory;
    use HasAnexo;

    protected $guarded = [];

    public function usuarioSolicitante()
    {
        return $this->belongsTo(User::class, 'solicitante_id');
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function localizacao()
    {
        return $this->belongsTo(Localizacao::class);
    }

    public function mensagens()
    {
        return $this->hasMany(Mensagens::class, 'chamado_id', 'id');
    }

    public function ultimaMensagem()
    {
        return $this->hasMany(Mensagens::class, 'chamado_id', 'id')->latest();
    }

    public function anexos()
    {
        return $this->hasMany(Anexos::class);
    }

    public function setor()
    {
        return $this->belongsTo(Setores::class);
    }

    public function transferencias()
    {
        return $this->hasMany(Transferencia::class, 'chamado_id', 'id');
    }
}
