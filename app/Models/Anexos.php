<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexos extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function chamado()
    {
        return $this->belongsTo(Chamado::class);
    }
}
