<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RemedioController;
use Illuminate\Support\Facades\Route;


Route::get('/',[IndexController::class,'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/medico',[MedicoController::class,'index'])->name('medico');
    Route::post('/prescricao/criar',[MedicoController::class,'criarPrescricao'])->name('criar.prescricao');
    Route::post('/marcar-prescricao-atendida/{id}',[FarmaciaController::class,'marcarPrescricaoAtendida'])->name('marcar.prescricao.atendida');

    #aqui vai servir tanto pra medico quanto p farmacia/recepcao 
    Route::get('/painel-buscar-guias',[FarmaciaController::class,'painelGuias'])->name('painel.guias');
    Route::get('/consultar-guias',[FarmaciaController::class,'consultarGuias'])->name('consultar.guias');

    Route::get('/farmacia',[FarmaciaController::class,'index'])->name('farmacia');
    Route::get('/remedios',[FarmaciaController::class,'remedios'])->name('remedios');

    Route::put('/remedios-atualizar-alerta/{id}',[FarmaciaController::class,'alertaEstoque'])->name('remedios.update.alerta');

    Route::get('/farmacia/entregar-medicamentos',[FarmaciaController::class,'index'])->name('entregar.medicamentos');
    Route::get('/guia/buscar',[FarmaciaController::class,'buscarGuia'])->name('guia.buscar');
    Route::get('/consultar-estoque',[FarmaciaController::class,'consultarEstoque'])->name('consultar.estoque');

    Route::get('/criar-remedio',[RemedioController::class,'create'])->name('criar.remedio');
    Route::get('/criar-estoque',[FarmaciaController::class,'criarLote'])->name('criar.lote');
    Route::post('/criar-lote',[FarmaciaController::class,'storeLote'])->name('store.lote');

    Route::get('/criar-usuario',[AdminController::class,'criarUsuario'])->name('criar.usuario');
    Route::post('/criar-usuario',[AdminController::class,'StoreUsuario'])->name('store.usuario');
    
});

require __DIR__.'/auth.php';
