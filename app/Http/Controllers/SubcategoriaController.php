<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubcategoriaController extends Controller
{
    public function index(): View
    {
        return view('categoria.index')->with('subcategorias', Subcategoria::all());
    }

    public function destroy($id)
    {
        $this->authorize('delete', Subcategoria::find($id));
        $categoria = Subcategoria::find($id);
        if($categoria->delete()){
            return back()->with('mensagem', "Categoria excluída");
        } else {
            return back()->with('mensagem', "Parece que ocorreu um erro.");
        }
    }
}
