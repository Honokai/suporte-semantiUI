<?php

namespace App\Traits;

use App\Models\Anexos;
use Illuminate\Http\Request;

trait HasAnexo {
    function hasAnexo(Request $request, $nomeInput = 'anexos')
    {
        if ($request->hasFile('anexos')) {
            foreach ($request->file($nomeInput) as $arquivo) {
                $caminho = $arquivo->storeAs('anexos/', $arquivo->getClientOriginalName(), 'public');
                if ($caminho) {
                    $anexo = new Anexos([
                        "caminho" => $caminho,
                        "nome" => $arquivo->getClientOriginalName()
                    ]);

                    $this->anexos()->save($anexo);
                }
            }
        }
    }
}