<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setores extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'responsavel',
        'cargo'
    ];

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }
    
    // public function chamados()
    // {
    //     return $this->hasManyThrough(Chamados::class, Categoria::class, 'setor_id', 'categoria_id', 'id');
    // }
}
