<?php

namespace App\Http\Controllers;

use App\Enums\StatusTipo;
use App\Http\Requests\ChamadoStoreRequest;
use App\Models\Anexos;
use App\Models\Categoria;
use App\Models\Chamados;
use App\Models\Localizacao;
use App\Models\Mensagens;
use App\Models\Setores;
use ErrorException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChamadosController extends Controller
{
    public function index(string $setor): View
    {
        return view("chamados")
            ->with(
                "chamados",
                Setores::where("nome", $setor)->get()?->first()?->chamados()->get()
            );
    }

    public function show($id)
    {
        return view("chamado")->with(["chamado" => Chamados::find($id), "categorias" => Categoria::all()]);
    }

    public function create()
    {
        return view("novoChamado")->with(
            [
                "setores" => Setores::all(),
                "localizacoes" => Localizacao::all(),
                "categorias" => Categoria::all()
            ]
        );
    }

    public function store(ChamadoStoreRequest $request)
    {
        $chamado = new Chamados;
        $chamado->solicitante_id = $request->solicitante_id;
        $chamado->setor_id = $request->setor_id;
        $chamado->categoria_id = $request->categoria_id;
        $chamado->localizacao_id = $request->localizacao_id;
        $chamado->status = StatusTipo::ABERTO;
        $chamado->save();
        $mensagem = new Mensagens;
        $mensagem->mensagem = $request->mensagem;
        $mensagem->chamado_id = $chamado->id;
        $mensagem->remetente_id = $request->solicitante_id;
        $chamado->mensagens()->save($mensagem);

        if($request->hasFile('anexos')) {
            $anexo = new Anexos;
            foreach($request->file('anexos') as $arquivo) {
                # armazena o arquivo em si e salva o caminho para armazenamento no banco
                $caminho = $arquivo->store("\\anexos\\{$chamado->id}", ['disk' => 'public']);
                if($caminho) {
                    $anexo->anexo = str_replace('/','\\',$caminho);
                    $anexo->chamados_id = $chamado->id;
                    $anexo->save();
                }
            }
        }

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
        if($request->has('status') && StatusTipo::coerce($request->status)) {
            $chamado->status = StatusTipo::coerce($request->status);
            $chamado->update();
        }
        return view('chamados')->with("chamados", Chamados::all());
    }

    public function showChamadoSetor($setor)
    {
        try {
            $setor = Setores::select('id')->where('setor', ''.$setor.'')->get();
            return view('chamados')
                ->with('chamados', Chamados::where('setor_id', $setor[0]->id)
                ->get());
        } catch(ErrorException $excecao) {
            return view('chamados')->with('chamados', []);
        }

    }
}
