<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\CatalogoController;
use App\Http\Controllers\Public\ContactoController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\UtilizadorController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\ViaturaController;
use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
Route::get('/catalogo/{viatura}', [CatalogoController::class, 'show'])->name('catalogo.show');
Route::get('/contactos', [ContactoController::class, 'index'])->name('contactos.index');
Route::post('/contactos', [ContactoController::class, 'store'])->name('contactos.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('utilizadores', UtilizadorController::class)
        ->middleware('can:gerir-utilizadores');

    //Export
    Route::get('/export/clientes', [ExportController::class, 'clientes'])->name('export.clientes');
    Route::get('/export/viaturas', [ExportController::class, 'viaturas'])->name('export.viaturas');
    Route::get('/export/vendas', [ExportController::class, 'vendas'])->name('export.vendas');

    // Clientes
    Route::get('/clientes', [ClienteController::class, 'index'])
        ->name('clientes.index')
        ->middleware('can:ver-clientes');

    Route::get('/clientes/create', [ClienteController::class, 'create'])
        ->name('clientes.create')
        ->middleware('can:criar-clientes');

    Route::post('/clientes', [ClienteController::class, 'store'])
        ->name('clientes.store')
        ->middleware('can:criar-clientes');

    Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])
        ->name('clientes.show')
        ->middleware('can:ver-clientes');

    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])
        ->name('clientes.edit')
        ->middleware('can:editar-clientes');

    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])
        ->name('clientes.update')
        ->middleware('can:editar-clientes');

    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])
        ->name('clientes.destroy')
        ->middleware('can:eliminar-clientes');

    // Viaturas
    Route::get('/viaturas', [ViaturaController::class, 'index'])
        ->name('viaturas.index')
        ->middleware('can:ver-viaturas');

    Route::get('/viaturas/create', [ViaturaController::class, 'create'])
        ->name('viaturas.create')
        ->middleware('can:criar-viaturas');

    Route::post('/viaturas', [ViaturaController::class, 'store'])
        ->name('viaturas.store')
        ->middleware('can:criar-viaturas');

    Route::get('/viaturas/{viatura}', [ViaturaController::class, 'show'])
        ->name('viaturas.show')
        ->middleware('can:ver-viaturas');

    Route::get('/viaturas/{viatura}/edit', [ViaturaController::class, 'edit'])
        ->name('viaturas.edit')
        ->middleware('can:editar-viaturas');

    Route::put('/viaturas/{viatura}', [ViaturaController::class, 'update'])
        ->name('viaturas.update')
        ->middleware('can:editar-viaturas');

    Route::delete('/viaturas/{viatura}', [ViaturaController::class, 'destroy'])
        ->name('viaturas.destroy')
        ->middleware('can:eliminar-viaturas');

    // Vendas
    Route::get('/vendas', [VendaController::class, 'index'])
        ->name('vendas.index')
        ->middleware('can:ver-vendas');

    Route::get('/vendas/create', [VendaController::class, 'create'])
        ->name('vendas.create')
        ->middleware('can:criar-vendas');

    Route::post('/vendas', [VendaController::class, 'store'])
        ->name('vendas.store')
        ->middleware('can:criar-vendas');

    Route::get('/vendas/{venda}', [VendaController::class, 'show'])
        ->name('vendas.show')
        ->middleware('can:ver-vendas');

    Route::get('/vendas/{venda}/edit', [VendaController::class, 'edit'])
        ->name('vendas.edit')
        ->middleware('can:editar-vendas');

    Route::put('/vendas/{venda}', [VendaController::class, 'update'])
        ->name('vendas.update')
        ->middleware('can:editar-vendas');

    Route::delete('/vendas/{venda}', [VendaController::class, 'destroy'])
        ->name('vendas.destroy')
        ->middleware('can:eliminar-vendas');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
