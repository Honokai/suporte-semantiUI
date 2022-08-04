<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;
use Psy\TabCompletion\Matcher\FunctionDefaultParametersMatcher;

class Categoria extends Model
{
    use HasFactory;

    public function setor()
    {
        return $this->belongsTo(Setores::class);
    }

    public function chamados()
    {
        return $this->hasMany(Chamados::class, 'categoria_id', 'id');
    }
}
