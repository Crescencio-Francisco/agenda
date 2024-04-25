<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/eventos', [EventoController::class, 'index'])->name('eventos');
Route::post('/evento/registar', [EventoController::class, 'create'])->name('registar.evento');
Route::get('/evento/editar/', [EventoController::class, 'edit'])->name('evento.editar');
Route::post('/evento/submeter/{id}', [EventoController::class, 'submeterFormuarioEditar'])->name('evento.submeter.formulario.editar');
Route::post('/evento/apagar',[EventoController::class,'destroy'])->name('evento.apagar');
