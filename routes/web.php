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


/*
|--------------------------------------------------------------------------
| Rotas de Gestão (Autenticadas)
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagementController; // Precisarei criar este controller ou separar

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Rotas acessíveis por ambos (Admin e Atendente)
    Route::get('/mgmt/chamados', [ChamadoController::class, 'listarMgmt'])->name('mgmt.chamados');
    Route::get('/mgmt/chamado/{hash}', [ChamadoController::class, 'detalhesMgmt'])->name('mgmt.chamado.detalhes');
    Route::post('/mgmt/chamado/{hash}/resposta', [ChamadoController::class, 'respostaMgmt'])->name('mgmt.chamado.resposta');

    // Rotas exclusivas de Administrador
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/mgmt/admin/dashboard', [ManagementController::class, 'adminDashboard'])->name('mgmt.admin.dashboard');
        Route::get('/mgmt/admin/atendentes', [ManagementController::class, 'listAttendants'])->name('mgmt.admin.atendentes');
        Route::post('/mgmt/admin/atendentes/store', [ManagementController::class, 'storeAttendant'])->name('mgmt.admin.atendentes.store');
        Route::delete('/mgmt/admin/atendentes/{id}', [ManagementController::class, 'destroyAttendant'])->name('mgmt.admin.atendentes.destroy');
    });

    // Rotas de Atendente (ou dashboard simplificado)
    Route::middleware(['role:attendant'])->group(function () {
        Route::get('/mgmt/attendant/dashboard', [ManagementController::class, 'attendantDashboard'])->name('mgmt.attendant.dashboard');
    });

});



