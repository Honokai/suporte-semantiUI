<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function create()
    {
        return view('categoria.create');
    }

    public function index()
    {
        return view('categoria.index')->with('categorias', Categoria::all());
    }

    public function destroy($id)
    {
        $this->authorize('delete', Categoria::find($id));
        $categoria = Categoria::find($id);
        if($categoria->delete()){
            return back()->with('mensagem', "Categoria excluída");
        } else {
            return back()->with('mensagem', "Parece que ocorreu um erro.");
        }
    }
}
