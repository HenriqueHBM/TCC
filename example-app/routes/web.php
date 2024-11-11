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
use App\Http\Controllers\MeusEventosController;
use App\Http\Controllers\PerfilController;

//Rota Controller (faz aparecer a pag. inicial), Ex: [Rota::get == pegando(/rotaURL, [Controller::class, funcao])]
Route::get('/', [HomeController::class, 'home'])->name('home');
//Redirecionando a rota /home para a rota "/"
Route::permanentRedirect('/home', '/');

// Rota para olhar as distribuições
Route::get('/distribuicoes', [DistribuicoesController::class ,'distribuicoes']);

// Rota para ver o produto em especifico
Route::get('/produto/{id}', [ProdutoController::class, 'produto']); //produto

Route::get('/eventos', [EventosController::class, 'enventos']);

Route::get('/criar_distribuicao', [CriarDistribuicaoController::class, 'criar_distribuicao']);

// middleware(permissao: caso esteja logado, pode acessar as rotas, senao, fazer o login)
Route::middleware(['auth'])->group(function(){
    
    // Rota par as entregas
    Route::get('/minhas_entregas', [MinhasEntregasController::class, 'minhas_entregas']);
    Route::post('/minhas_entregas/{id}/excluir', [MinhasEntregasController::class, 'excluir']);
    Route::get('/minhas_entregas/{id}/editar', [MinhasEntregasController::class, 'editar']);
    Route::post('/minhas_entregas/{id}/editar/save_editar', [MinhasEntregasController::class, 'save_editar']);
    
    // Rota para cadastrar o endereço
    Route::get('/cadastrar_endereco', [CadastrarEnderecoController::class, 'cadastrar_endereco']);

    Route::post('/eventos/save_cadastro', [EventosController::class, 'save_cadastro']);
    Route::get('/eventos/termo_evento', [EventosController::class, 'termo_evento']);
    Route::post('/eventos/confirmarcao_termo', [EventosController::class, 'confirmarcao_termo']); 
    Route::post('/eventos/cadastrar_evento', [EventosController::class, 'cadastrar_evento']); 
    
    // Rotas para visualizar eventos
    Route::get('/eventos/visualizar_evento/{id}', [EventosController::class, 'visualizar_evento']);
    Route::get('/meus_eventos', [MeusEventosController::class, 'meus_eventos']);
    Route::get('/meus_eventos/{id}/editar_evento', [MeusEventosController::class, 'editar_evento']);
    Route::post('/meus_eventos/{id}/excluir', [MeusEventosController::class, 'excluir']);

    // Rota pra salvar distribuição
    Route::post('/criar_distribuicao/save_distribuicao', [CriarDistribuicaoController::class, 'save_distribuicao']);

    //Rota para confirmar compra
    Route::get('produto/{id}/show_comprar', [ProdutoController::class, 'show_comprar']);
    Route::post('produto/confirmar_compra/{id}', [ProdutoController::class, 'confirmar_compra']);
    Route::get('produto/{id}/recibo_compra/{id_compra}', [ProdutoController::class, 'recibo_compra']);
    Route::get('produto/{id}/termo_compra', [ProdutoController::class, 'termo_compra']);
    Route::post('produto/{id}/confirmarcao_termo', [ProdutoController::class, 'confirmarcao_termo']);

    //Rotas para do perfil
    Route::get('/perfil', [PerfilController::class, 'perfil']);
    Route::post('/perfil/save_perfil', [PerfilController::class, 'save_perfil']);
    
});


Route::post('/cadastrar_endereco/save_register', [CadastrarEnderecoController::class, 'save_register']);

