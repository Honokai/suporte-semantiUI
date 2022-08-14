<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function create()
    {
        return view('categoria.create');
    }

    public function index()
    {
        return view('categoria.index')->with('categorias', Categoria::with(['subcategorias' => function($subcategorias) {
            $subcategorias->withTrashed();
        }])->withTrashed()->where('setor_id', auth()->user()->setor_id)->get());
    }

    public function destroy($id)
    {
        $this->authorize('delete', Categoria::find($id));
        $categoria = Categoria::find($id);
        if($categoria->delete()){
            return back()->with("mensagem.negativa", "Categoria desativada.");
        } else {
            return back()->withErrors(["mensagem" => "Parece que ocorreu um erro."]);
        }
    }

    public function restore($categoria)
    {
        try {
            $categoria = Categoria::withTrashed()->findOrFail($categoria);
            DB::transaction(function () use ($categoria){
                $categoria->restore();
            });
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th);
            
            return back()->with(["mensagem.negativa" => "Ocorreu um erro ao tentar processar sua requisição."]);
        }
        
        return back()->with('mensagem.positiva', 'Categoria reativada.');
    }
}
