<?php

namespace App\Http\Controllers;

use App\Models\Chamados;
use Illuminate\Http\Request;

class ChamadosController extends Controller
{
    public function index()
    {
        return view('chamados')->with("chamados", Chamados::all());
    }

    public function show($id)
    {
        return view('chamado')->with("chamado", Chamados::find($id));
    }
}
