<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SubcategoriaController extends Controller
{
    public function index(): View
    {
        return view('categoria.index')->with('subcategorias', Subcategoria::all());
    }

    public function create(\App\Models\Categoria $categoria)
    {
        return view('subcategoria.create')->with('categoria', $categoria->id);
    }

    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Subcategoria::create($request->except('_token'));
            });
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th);

            return back()->with('mensagem.negativa', 'Ocorreu um erro ao tentar processar sua requisição');
        }

        return back()->with('refresh', true);
    }

    public function destroy(Subcategoria $subcategoria)
    {
        try {
            DB::transaction(function () use ($subcategoria) {
                // $this->authorize('delete', Subcategoria::find($subcategoria));
                $subcategoria->delete();
            });
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th);

            return back()->with('mensagem.negativa', "Parece que ocorreu um erro.");
        }

        return back()->with('mensagem.negativa', "Subcategoria desativada.");
    }

    public function restore($subcategoria)
    {
        try {
            $subcategoria = Subcategoria::withTrashed()->findOrFail($subcategoria);
            DB::transaction(function () use ($subcategoria){
                $subcategoria->restore();
            });
        } catch (\Throwable $th) {
            DB::rollBack();
            info($th);
            
            return back()->with(["mensagem.negativa" => "Ocorreu um erro ao tentar processar sua requisição."]);
        }
        
        return back()->with('mensagem.positiva', 'Subcategoria reativada.');
    }
}
