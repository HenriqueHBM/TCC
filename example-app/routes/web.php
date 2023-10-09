<?php

use App\Http\Controllers\CriarDistribuicaoController;
use App\Http\Controllers\DistribuicoesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MinhasEntregasController;
use App\Http\Controllers\ProdutoController;

//Rota Controller (faz aparecer a pag. inicial), Ex: [Rota::get == pegando(/rotaURL, [Controller::class, funcao])]
Route::get('/', [HomeController::class, 'home']);
Route::get('/home', [HomeController::class, 'home']);

// Rota par as entregas
Route::get('/minhas_entregas', [MinhasEntregasController::class, 'minhas_entregas']); 

// Rota para criar as distribuições
Route::get('/criar_distribuicao', [CriarDistribuicaoController::class, 'criar_distribuicao']);

// Rota para olhar as distribuições
Route::get('/distribuicoes', [DistribuicoesController::class ,'distribuicoes']);

Route::get('/produto/{id}', [ProdutoController::class, 'produto']);