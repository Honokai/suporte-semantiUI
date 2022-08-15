<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ChamadosController;
use App\Http\Controllers\SetoresController;
use App\Http\Controllers\SubcategoriaController;
use App\Models\Chamados;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function(){
    Route::resource('chamados', 'App\Http\Controllers\ChamadosController')->except('index', 'show');
    Route::resource('mensagens', 'App\Http\Controllers\MensagensController');
    Route::resource('categorias', 'App\Http\Controllers\CategoriaController');
    Route::resource('subcategorias', 'App\Http\Controllers\SubcategoriaController')->except('show', 'create');
    Route::resource('setores', 'App\Http\Controllers\SetoresController');
    
    Route::put('categorias/{categoria}/restore', [CategoriaController::class, 'restore'])->name('categorias.restore');
    Route::put('subcategorias/{subcategoria}/restore', [SubcategoriaController::class, 'restore'])->name('subcategorias.restore');
    Route::put('setores/{setor}/restore', [SetoresController::class, 'restore'])->name('setores.restore');

    Route::get('subcategorias/create/{categoria}', [SubcategoriaController::class, 'create'])->name('subcategorias.create');
    Route::get('chamados/{nomeSetor}', [ChamadosController::class, 'index'])->name('chamado.index');
    Route::get('chamado/{chamado}', [ChamadosController::class, 'show'])->name('chamado.show');
    Route::get('/dashboard', function () {
        return view('dashboard')
            ->with("chamados", Chamados::where('solicitante_id', Auth::user()->id)->get());
    })->name('dashboard');
});

require __DIR__.'/auth.php';
