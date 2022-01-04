<?php

namespace App\Http\Controllers;

use App\Models\Setores;
use App\Models\User;
use Illuminate\Http\Request;

class SetoresController extends Controller
{
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
}
