<?php

use App\Http\Controllers\RevisaoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\CarroController;
use App\Http\Controllers\RelatorioController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//Rotas para gerenciamento de Pessoas.
Route::get('/pessoa', [PessoaController::class, 'index'])->name('pessoa.index');
Route::post('/pessoa', [PessoaController::class, 'index'])->name('pessoa.index.filtro');
Route::get('/pessoa/create', [PessoaController::class, 'create'])->name('pessoa.create');
Route::post('/pessoa/store', [PessoaController::class, 'store'])->name('pessoa.store');
Route::get('/pessoa/edit/{id}', [PessoaController::class, 'edit'])->name('pessoa.edit');
Route::post('/pessoa/update/{pessoa}', [PessoaController::class, 'update'])->name('pessoa.update');
Route::post('pessoa/getPessoas', [PessoaController::class, 'getPessoas'])->name('pessoa.getPessoas');
Route::delete('/pessoa/{pessoa}', [PessoaController::class, 'destroy'])->name('pessoa.destroy');

//Rotas para gerenciamento de Carros.
Route::get('/carro', [CarroController::class, 'index'])->name('carro.index');
Route::get('/carro/{id}', [CarroController::class, 'index'])->name('carro.index.pessoa');
Route::get('/carro/create/{pessoa_id}', [CarroController::class, 'create'])->name('carro.create');
Route::post('/carro/store', [CarroController::class, 'store'])->name('carro.store');
Route::get('/carro/edit/{id}', [CarroController::class, 'edit'])->name('carro.edit');
Route::post('/carro/update/{carro}', [CarroController::class, 'update'])->name('carro.update');
Route::post('carro/getCarros', [CarroController::class, 'getCarros'])->name('carro.getCarros');
Route::delete('/carro/{carro}', [CarroController::class, 'destroy'])->name('carro.destroy');


//Rotas para gerenciamento de Revisão.
Route::get('/revisao', [RevisaoController::class, 'index'])->name('revisao.index');
Route::get('/revisao/create', [RevisaoController::class, 'create'])->name('revisao.create');
Route::post('/revisao/store', [RevisaoController::class, 'store'])->name('revisao.store');
Route::get('/revisao/edit/{id}', [RevisaoController::class, 'edit'])->name('revisao.edit');
Route::post('/revisao/update/{revisao}', [RevisaoController::class, 'update'])->name('revisao.update');
Route::delete('/revisao/{revisao}', [RevisaoController::class, 'destroy'])->name('revisao.destroy');
Route::post('/revisao/logout/', [RevisaoController::class, 'logout'])->name('logout');

//Rotas para utilização de Relatórios
Route::get('/relatorio/pessoa', [RelatorioController::class, 'pessoas'])->name('relatorio.pessoa');
Route::get('/relatorio/carro', [RelatorioController::class, 'carros'])->name('relatorio.carro');