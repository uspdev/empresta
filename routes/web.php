<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\UserController;

Route::get('/', [LoginController::class, 'index']);
Route::get('/home', function () {
    return view('home');
});
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'authenticate']);
Route::get('loginusp',[LoginController::class, 'redirectToProvider'])->name('loginusp');
Route::get('callback', [LoginController::class, 'handleProviderCallback']);
Route::post('logout',[LoginController::class, 'logout'])->name('logout');

Route::get('emprestimos/relatorio', [EmprestimoController::class,'relatorio'])->name('emprestimos.relatorio');
Route::get('emprestimos/usp', [EmprestimoController::class,'usp'])->name('emprestimos.usp');
Route::get('emprestimos/visitante', [EmprestimoController::class,'visitante'])->name('emprestimos.visitante');
Route::get('emprestimos/devolucao', [EmprestimoController::class,'devolucao'])->name('emprestimos.devolucao');
Route::post('emprestimos/devolver', [EmprestimoController::class,'devolver'])->name('emprestimos.devolver');

Route::resource('categorias', CategoriaController::class);
Route::resource('materials', MaterialController::class);
Route::resource('visitantes', VisitanteController::class);
Route::resource('emprestimos', EmprestimoController::class);
Route::resource('users', UserController::class);

Route::get('teste', [CategoriaController::class,'teste']);



//Auth::routes();

