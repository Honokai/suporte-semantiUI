<?php

namespace App\Http\Controllers;

use App\Models\Chamados;
use App\Models\Mensagens;
use Illuminate\Http\Request;

class ChamadosController extends Controller
{
    public function index()
    {
        return view('chamados')->with("chamados", Chamados::orderByDesc('created_at')->get());
    }

    public function show($id)
    {
        return view('chamado')->with("chamado", Chamados::find($id));
    }

    public function create()
    {
        return view('novoChamado');
    }

    public function store(Request $request)
    {
        $chamado = new Chamados;
        $chamado->solicitante_id = $request->solicitante_id;
        $chamado->setor_id = $request->setor_id;
        $chamado->categoria_id = $request->categoria_id;
        $chamado->localizacao_id = $request->localizacao_id;
        $chamado->save();
        $mensagem = new Mensagens;
        $mensagem->mensagem = $request->mensagem;
        $mensagem->chamado_id = $chamado->id;
        $mensagem->remetente_id = $request->solicitante_id;
        $chamado->mensagens()->save($mensagem);
        return view('chamados')->with("chamados", Chamados::all());
    }

    public function update(Request $request, $id)
    {
        $chamado = Chamados::find($id);
        if($request->filled(['categoria_id', 'setor_id', 'localizacao_id'])) {
            $chamado->categoria_id = $request->id;
            $chamado->setor_id = $request->setor_id;
            $chamado->localizacao_id = $request->localizacao->id;
            $chamado->update();
        }
        return view('chamados')->with("chamados", Chamados::all());
    }
}
