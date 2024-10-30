<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RemessaController;

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

Route::get('/', function () { return view('home'); });

Route::get('/importacao', [RemessaController::class, 'index'] )->name('remessas');

// Route::get('/importacao', function () { return view('importacao.remessas'); })->name('remessas');

Route::get('/remessas/{remessa}/itens', [RemessaController::class, 'fetchItens'])->name('remessas.fetchItens');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
