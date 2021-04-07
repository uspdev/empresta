<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\EmprestimoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[LoginController::class, 'redirectToProvider'])->name('login');
Route::get('callback', [LoginController::class, 'handleProviderCallback']);
Route::get('logout',[LoginController::class, 'logout'])->name('logout');

Route::get('emprestimos/relatorio', [EmprestimoController::class,'relatorio'])->name('emprestimos.relatorio');

Route::resource('categorias', CategoriaController::class);
Route::resource('materials', MaterialController::class);
Route::resource('visitantes', VisitanteController::class);
Route::resource('emprestimos', EmprestimoController::class);

Route::get('teste', [CategoriaController::class,'teste']);


