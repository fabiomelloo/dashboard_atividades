<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtividadeController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('atividades', AtividadeController::class);


Route::get('/dashboard', [AtividadeController::class, 'index'])->name('dashboard'); 
Route::put('/atividades/{atividade}/concluir', [AtividadeController::class, 'concluir'])->name('atividades.concluir');
Route::put('/atividades/{atividade}/reabrir', [AtividadeController::class, 'reabrir'])->name('atividades.reabrir');         
Route::delete('/atividades/{atividade}', [AtividadeController::class, 'destroy'])->name('atividades.destroy');
Route::get('/atividades/{atividade}/editar', [AtividadeController::class, 'edit'])->name('atividades.editar');
Route::put('/atividades/{atividade}', [AtividadeController::class, 'update'])->name('atividades.atualizar');
Route::get('/atividades/criar', [AtividadeController::class, 'create'])->name('atividades.criar');
Route::post('/atividades', [AtividadeController::class, 'store'])->name('atividades.store');
Route::get('/atividades', [AtividadeController::class, 'index'])->name('atividades.index');
Route::get('/atividades/{atividade}', [AtividadeController::class, 'show'])->name('atividades.show');