<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RemessaController;
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

Route::get('/remessas', [RemessaController::class, 'index'] )->name('remessas');

Route::get('/remessas/{remessa}/itens', [RemessaController::class, 'fetchItens'])->name('remessaitens');

Route::post('/upload-remessa-json', [RemessaController::class, 'uploadJson']);

Route::post('/remessa', [RemessaController::class, 'store'])->name('insereRemessa');

Route::post('/remessa/{remessa}/item', [RemessaItemController::class, 'store'])->name('insereRemessaitem');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/filatarefa/{remessa}', [FilaTarefaController::class, 'insereTarefa'])->name('filatarefa.insereTarefa');

Route::get('/filatarefa', [FilaTarefaController::class, 'create'])->name('filatarefa.create');
