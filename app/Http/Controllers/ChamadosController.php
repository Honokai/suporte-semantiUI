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
use App\Models\Subcategoria;
use App\Models\User;
use Carbon\Carbon;
use ErrorException;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChamadosController extends Controller
{
    public function index(string $setor): View
    {
        return view('chamado.index', ['setor' => $setor]);
    }

    public function show(Chamados $chamado)
    {
        return view('chamado.show_edit')->with(["chamado" => $chamado, "subcategorias" => Subcategoria::all()]);
    }

    public function create()
    {

        return view('chamado.create')->with(
            [
                "setores" => Setores::all(),
                "localizacoes" => Localizacao::all(),
                "subcategorias" => Subcategoria::join(
                    'categorias',
                    'subcategorias.categoria_id',
                    'categorias.id'
                )->join('setores', 'categorias.setor_id', 'setores.id')
                ->select(
                    'subcategorias.id',
                    'setores.nome as nome',
                    'categorias.nome as categoria_nome',
                    'subcategorias.nome as subcategoria_nome',
                    'subcategorias.deleted_at'
                )->orderBy('setores.nome')->get()
            ]
        );
    }

    public function store(ChamadoStoreRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $chamado = new Chamados($request->except(['_token', 'ramal', 'anexos']));
                $chamado->solicitante = Auth::user()->name;
                $chamado->save();

                $chamado->hasAnexo($request);
            });

            return back()->with('suporte', Subcategoria::find($request->subcategoria_id)->categoria->setor->nome);
        } catch (\Throwable $th) {
            info($th);
            abort(403, 'Ocorreu um erro ao tentar processar sua requisição em armazenar.');
        }
    }

    public function update(Request $request, Chamados $chamado)
    {
        $usuario_id = auth()->user()->id;
        try {
            if($request->has('mudar_categoria_id')) {
                $chamado->categoria_id = $request->mudar_categoria_id;
            }

            if($chamado->status == "aberto" && auth()->user()->setor_id == $chamado->subcategoria->categoria->setor->id) {
                $chamado->status = StatusTipo::ANDAMENTO;
            }

            if(auth()->user()->setor_id == $chamado->subcategoria->categoria->setor->id) {
                $chamado->responsavel_id = $usuario_id;
            }

            if($request->has('status')) {
                if($request->status == 'encerrado') {
                    $chamado->data_conclusao = Carbon::now();
                }
                $chamado->status = StatusTipo::coerce(strtoupper($request->status));
            }

            if($chamado->solicitante_id == $usuario_id) {
                $chamado->respondido = 1;
            } else {
                $chamado->respondido = 0;
            }

            DB::transaction(function () use ($chamado, $request, $usuario_id) {
                $chamado->hasAnexo($request);

                $chamado->mensagens()->create([
                    'mensagem' => $request->mensagem,
                    'remetente_id' => $usuario_id
                ]);
                
                $chamado->update();
            });

            return back()->with('suporte', Subcategoria::find($request?->subcategoria_id ?? $chamado->subcategoria->id)->categoria->setor->nome);
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th);
            abort(403, 'Ocorreu um erro ao tentar processar sua requisição em atualizar.');
        }
    }
}
