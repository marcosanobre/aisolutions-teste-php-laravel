<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RemessaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\FilaTarefaController;
use App\Http\Controllers\RemessaItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { return view('home'); })->name('home');


// REMESSAS

Route::get('/remessas', [RemessaController::class, 'index'] )->name('remessas');

Route::get('/remessas/{remessa}/itens', [RemessaController::class, 'fetchItens'])->name('remessaitens');

Route::post('/upload-remessa-json', [RemessaController::class, 'uploadJson']);

Route::post('/remessa', [RemessaController::class, 'store'])->name('insereRemessa');

Route::post('/remessa/{remessa}/item', [RemessaItemController::class, 'store'])->name('insereRemessaitem');

// TAREFAS

Route::get('/filatarefa/processaTarefa/{filatarefa}', [FilaTarefaController::class, 'processaTarefa'])->name('filatarefa.processaTarefa');

Route::get('/filatarefa/insereRemessa/{remessa}', [FilaTarefaController::class, 'insereTarefa'])->name('filatarefa.insereTarefa');

Route::get('/tarefas', [FilaTarefaController::class, 'index'] )->name('tarefas');

// DOCUMENTOS

Route::get('/documentos', [DocumentoController::class, 'index'] )->name('documentos');

Route::get('/documento/{doc}/itens', [DocumentoController::class, 'fetchItens'])->name('documentoitens');

Route::get('/documento/{doc}', [DocumentoController::class, 'showDocumento'])->name('documentoshow');

// LOGS

Route::get('/logs', [RemessaController::class, 'showLogs'] )->name('logs');

Route::get('/log/{remessa}', [RemessaController::class, 'showLogRemessa'])->name('logshow');

