<?php

namespace App\Http\Controllers;

use App\Models\Setores;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SetoresController extends Controller
{
    public function index(): View
    {
        return view('setor.index', ['setores' => Setores::all()]);
    }

    public function create()
    {
        $usuarios = User::all();
        return view('setor.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $setor = new Setores($request->only(['nome', 'responsavel']));
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
        
        return back()->with('mensagem', 'Setor desativado.');
    }
}
