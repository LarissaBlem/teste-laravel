<?php

use App\Http\Controllers\RevisaoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\CarroController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('products', ProductController::class);
Route::resource('pessoa', PessoaController::class);
Route::post('pessoa/getPessoas', [PessoaController::class, 'getPessoas'])->name('pessoa.getPessoas');
Route::post('/pessoa', [PessoaController::class, 'index'])->name('pessoa.index.filtro');
Route::get('/pessoa', [PessoaController::class, 'index'])->name('pessoa.index');
Route::get('/pessoa/create', [PessoaController::class, 'create'])->name('pessoa.create');
Route::post('/pessoa/store', [PessoaController::class, 'store'])->name('pessoa.store');
// Route::resource('carro', CarroController::class);

//Rotas para gerenciamento de Carros.
Route::get('/carro/create/{id}', [CarroController::class, 'create'])->name('carro.create');
Route::get('/carro/{id}', [CarroController::class, 'index'])->name('carro.index.pessoa');
Route::delete('/carro/{carro}', [CarroController::class, 'destroy'])->name('carro.destroy');
Route::get('/carro/edit/{id}', [CarroController::class, 'edit'])->name('carro.edit');
Route::post('/carro/update/{carro}', [CarroController::class, 'update'])->name('carro.update');
Route::get('/carro', [CarroController::class, 'index'])->name('carro.index');
Route::post('carro/getCarros', [CarroController::class, 'getCarros'])->name('carro.getCarros');
Route::post('/carro/store', [CarroController::class, 'store'])->name('carro.store');


Route::get('/revisao/create', [RevisaoController::class, 'create'])->name('revisao.create');
Route::post('/revisao/store', [RevisaoController::class, 'store'])->name('revisao.store');
Route::get('/revisao', [RevisaoController::class, 'index'])->name('revisao.index');
Route::delete('/revisao/{revisao}', [RevisaoController::class, 'destroy'])->name('revisao.destroy');
Route::get('/revisao/edit/{id}', [RevisaoController::class, 'edit'])->name('revisao.edit');
Route::post('/revisao/update/{revisao}', [RevisaoController::class, 'update'])->name('revisao.update');

Route::post('/revisao/logout/', [RevisaoController::class, 'logout'])->name('logout');