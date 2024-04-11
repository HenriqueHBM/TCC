<?php
// rotas de autenticacao
require __DIR__.'/auth.php';

use App\Http\Controllers\CriarDistribuicaoController;
use App\Http\Controllers\DistribuicoesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MinhasEntregasController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CadastrarEnderecoController;

//Rota Controller (faz aparecer a pag. inicial), Ex: [Rota::get == pegando(/rotaURL, [Controller::class, funcao])]
Route::get('/', [HomeController::class, 'home'])->name('home');
// Route::get('/home', [HomeController::class, 'home']);

// Rota para olhar as distribuições
Route::get('/distribuicoes', [DistribuicoesController::class ,'distribuicoes']);

// Rota para ver o produto em especifico
Route::get('/produto/{id}', [ProdutoController::class, 'produto']);

// middleware(permissao: caso esteja logado, pode acessar as rotas, senao, fazer o login)
Route::middleware(['auth'])->group(function(){
    
    // Rota par as entregas
    Route::get('/minhas_entregas', [MinhasEntregasController::class, 'minhas_entregas']); 
    // Rota para criar as distribuições
    Route::get('/criar_distribuicao', [CriarDistribuicaoController::class, 'criar_distribuicao']);
    // Rota para cadastrar o endereço
    Route::get('/cadastrar_endereco', [CadastrarEnderecoController::class, 'cadastrar_endereco']);

});


Route::post('/cadastrar_endereco/save_register', [CadastrarEnderecoController::class, 'save_register']);