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
use App\Http\Controllers\EventosController;

//Rota Controller (faz aparecer a pag. inicial), Ex: [Rota::get == pegando(/rotaURL, [Controller::class, funcao])]
Route::get('/', [HomeController::class, 'home'])->name('home');
//Redirecionando a rota /home para a rota "/"
Route::permanentRedirect('/home', '/');

// Rota para olhar as distribuições
Route::get('/distribuicoes', [DistribuicoesController::class ,'distribuicoes']);

// Rota para ver o produto em especifico
Route::get('/produto/{id}', [ProdutoController::class, 'produto']);

Route::get('/eventos', [EventosController::class, 'enventos']);

Route::get('/criar_distribuicao', [CriarDistribuicaoController::class, 'criar_distribuicao']);

// middleware(permissao: caso esteja logado, pode acessar as rotas, senao, fazer o login)
Route::middleware(['auth'])->group(function(){
    
    // Rota par as entregas
    Route::get('/minhas_entregas', [MinhasEntregasController::class, 'minhas_entregas']);
    
    // Rota para cadastrar o endereço
    Route::get('/cadastrar_endereco', [CadastrarEnderecoController::class, 'cadastrar_endereco']);

    Route::post('/eventos/save_cadastro', [EventosController::class, 'save_cadastro']);
    // Rotas para visualizar eventos
    Route::get('/eventos/visualizar_evento/{id}', [EventosController::class, 'visualizar_evento']);

    // Rota pra salvar distribuição
    Route::post('/criar_distribuicao/save_distribuicao', [CriarDistribuicaoController::class, 'save_distribuicao']);

    //Rota para confirmar compra
    Route::post('produto/confirmar_compra/{id}', [ProdutoController::class, 'confirmar_compra']);

    
});
Route::get('produto/{id}/show_comprar', [ProdutoController::class, 'show_comprar']);

Route::post('/cadastrar_endereco/save_register', [CadastrarEnderecoController::class, 'save_register']);


