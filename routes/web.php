<?php

use App\Http\Controllers\ChamadosController;
use App\Models\Chamados;
use App\Models\Setores;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function(){
    Route::resource('chamados', 'App\Http\Controllers\ChamadosController')->except('index', 'show');
    Route::resource('mensagens', 'App\Http\Controllers\MensagensController');
    Route::resource('categorias', 'App\Http\Controllers\CategoriaController');
    Route::resource('setores', 'App\Http\Controllers\SetoresController');
    Route::get('chamados/{nomeSetor}', [ChamadosController::class, 'index'])->name('chamado.index');
    Route::get('chamado/{chamado}', [ChamadosController::class, 'show'])->name('chamado.show');
});

Route::get('/dashboard', function () {
    return view('dashboard')
        ->with("chamados", Chamados::where('solicitante_id', Auth::user()->id)->get())
        ;
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
