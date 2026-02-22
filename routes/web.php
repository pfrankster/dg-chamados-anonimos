<?php

use Illuminate\Support\Facades\Route;
use App\Models\Chamado;
use App\Models\Interaction;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\InteractionController;


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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/chamado', [ChamadoController::class, 'store']);
Route::post('/consulta', [ChamadoController::class, 'consultar']);
Route::post('/interacao', [InteractionController::class, 'store']);
Route::post('/fechar-chamado', [ChamadoController::class, 'fechar']);


// Rota para exibir o formulário de novo chamado
Route::get('/chamado/novo', [ChamadoController::class, 'create'])->name('chamado.create');

// Rota para processar o formulário de novo chamado
Route::post('/chamado/store', [ChamadoController::class, 'store'])->name('chamado.store');

// Rota para exibir o formulário de consulta de chamado
Route::get('/chamado/consulta', [ChamadoController::class, 'showConsulta'])->name('chamado.consulta');

// Rota para buscar um chamado existente
Route::post('/chamado/buscar', [ChamadoController::class, 'buscar'])->name('chamado.buscar');

// Rota para visualizar detalhes e interações do chamado
Route::get('/chamado/{hash}/detalhes', [ChamadoController::class, 'detalhes'])->name('chamado.detalhes');

// Rota para adicionar uma interação ao chamado
Route::post('/chamado/{hash}/interagir', [ChamadoController::class, 'interagir'])->name('chamado.interagir');


//ROTAS DO ADMIN

// Rota para listar os chamados do administrador
Route::get('/admin/chamados', [ChamadoController::class, 'listar'])->name('admin.chamados');

// Rota para visualizar detalhes do chamado
Route::get('/admin/chamado/{hash}', [ChamadoController::class, 'detalhesAdmin'])->name('admin.chamado.detalhes');

// Rota para adicionar respostas como administrador
Route::post('/admin/chamado/{hash}/resposta', [ChamadoController::class, 'respostaAdmin'])->name('admin.chamado.resposta');
