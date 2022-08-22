<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetorStoreRequest;
use App\Models\Setores;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SetoresController extends Controller
{
    public function index(): View
    {
        return view('setor.index', ['setores' => Setores::withTrashed()->get()]);
    }

    public function create()
    {
        $usuarios = User::all();
        return view('setor.create', compact('usuarios'));
    }

    public function store(SetorStoreRequest $request)
    {
        $setor = new Setores($request->only(['nome', 'responsavel_id']));
        if($setor->save()) {
            return back()->with('sucesso', 'Legal');
        } 
        
        return back()->withErrors(['erro' => 'Que triste']);
    }

    public function destroy(Setores $setore)
    {
        DB::transaction(function () use ($setore) {
            $setore->delete();
        });
        
        return back()->with('mensagem.negativa', 'Setor desativado, não será possível abrir solicitações para o mesmo.');
    }

    public function restore($setor)
    {
        try {
            $setor = Setores::withTrashed()->findOrFail($setor);
            DB::transaction(function () use ($setor){
                $setor->restore();
            });
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th);
            
            return back()->with(["mensagem.negativa" => "Ocorreu um erro ao tentar processar sua requisição."]);
        }
        
        return back()->with('mensagem.positiva', 'Setor reativado.');
    }

    public function edit(Setores $setore)
    {
        return view('setor.edit')->with('setor', $setore);
    }

    public function update(Setores $setore)
    {
        
    }
}
