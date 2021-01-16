<?php

use App\Http\Controllers\ChamadosController;
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

Route::resource('chamados', 'App\Http\Controllers\ChamadosController')->middleware(['auth']);
Route::resource('mensagens', 'App\Http\Controllers\MensagensController')->middleware(['auth']);
Route::get('chamados/setor/{setorId}', [ChamadosController::class, 'showChamadoSetor']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

