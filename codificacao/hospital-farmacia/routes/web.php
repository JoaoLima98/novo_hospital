<?php

use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\RemedioController;
use App\Models\Paciente;
use Illuminate\Support\Facades\Route;

Route::get('/medico',[MedicoController::class,'index'])->name('medico');
Route::post('/prescricao/criar',[MedicoController::class,'criarPrescricao'])->name('criar.prescricao');
Route::post('/marcar-prescricao-atendida/{id}',[FarmaciaController::class,'marcarPrescricaoAtendida'])->name('marcar.prescricao.atendida');

#aqui vai servir tanto pra medico quanto p farmacia/recepcao 
Route::get('/painel-buscar-guias',[FarmaciaController::class,'painelGuias'])->name('painel.guias');
Route::get('/consultar-guias',[FarmaciaController::class,'consultarGuias'])->name('consultar.guias');

Route::get('/farmacia',[FarmaciaController::class,'index'])->name('farmacia');
Route::get('/farmacia/entregar-medicamentos',[FarmaciaController::class,'index'])->name('entregar.medicamentos');
Route::get('/guia/buscar',[FarmaciaController::class,'buscarGuia'])->name('guia.buscar');
Route::get('/consultar-estoque',[FarmaciaController::class,'consultarEstoque'])->name('consultar.estoque');

Route::get('/criar-remedio',[RemedioController::class,'create'])->name('criar.remedio');
Route::get('/criar-estoque',[FarmaciaController::class,'criarLote'])->name('criar.lote');
Route::post('/criar-lote',[FarmaciaController::class,'storeLote'])->name('lote.store');


Route::get('/',function(){
    return view('index');
})->name('home');

Route::post('/marcar-prescricao-atendida/{id}', [MedicoController::class, 'marcarPrescricaoAtendida'])
    ->name('marcar.prescricao.atendida');