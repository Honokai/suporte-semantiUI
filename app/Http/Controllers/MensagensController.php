<?php

namespace App\Http\Controllers;

use App\Models\Mensagens;
use Illuminate\Http\Request;

class MensagensController extends Controller
{
    public function store(Request $request)
    {
        $novaMensagem = new Mensagens;
        $novaMensagem->mensagem = $request->mensagem;
        $novaMensagem->chamado_id = $request->chamado_id;
        $novaMensagem->remetente_id = $request->remetente_id;
        $novaMensagem->save();

        return view('mensagem')->with('mensagem', $novaMensagem);
    }
}
