<?php

namespace App\Http\Controllers;

use App\Models\Chamados;
use App\Models\Setores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardServices extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if($request->setor) {
            // dd(Setores::find(Auth::user()->setor->id)->chamados->where());
            return view('dashboard.show.chamados')->with(
                [
                    'chamados'=> Setores::find(Auth::user()->setor->id)->chamados()->where('status', $request->status)->get()
                ]
            );
        } else  {
            return view('dashboard.show.chamados')->with(
                [
                    'chamados'=> Chamados::where('solicitante_id', Auth::user()->id)
                    ->where('status', $request->status)->get()
                ]
            );
            // $request->status;
        }
    }
}
