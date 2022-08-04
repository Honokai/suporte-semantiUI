<?php

use App\Http\Controllers\ChamadosController;
use App\Models\Chamados;
use App\Models\Setores;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('inicio');
});

Route::middleware('auth')->group(function(){
    Route::resource('chamados', 'App\Http\Controllers\ChamadosController')->except('index', 'show');
    Route::resource('mensagens', 'App\Http\Controllers\MensagensController');
    Route::resource('categorias', 'App\Http\Controllers\CategoriaController');
    Route::resource('setores', 'App\Http\Controllers\SetoresController');
});


Route::get('chamados/{nomeSetor}', [ChamadosController::class, 'index'])->name('chamado.index');
Route::get('chamado/{id}', [ChamadosController::class, 'show'])->name('chamado.show');

Route::get('/dashboard', function () {
    return view('dashboard')
        ->with("chamados", Chamados::where('solicitante_id', Auth::user()->id)->get())
        ->with("setor", Setores::find(Auth::user()?->setor_id)?->chamados()->get());
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

