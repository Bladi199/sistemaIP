<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\AlertActionController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


// 🟢 SOLO USUARIOS LOGUEADOS
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// 🟡 ADMIN + USUARIO + OPERADOR
Route::middleware(['auth', 'role:admin,usuario,operador'])->group(function () {

    // Productos
    Route::resource('products', ProductController::class);

    // Movimientos
    Route::get('/movements', [MovementController::class, 'index'])
        ->name('movements.index');

    // Inventario
    Route::get('/inventory', [InventoryController::class, 'index'])
        ->name('inventory.index');

    Route::post('/inventory/entry', [InventoryController::class, 'storeEntry'])
        ->name('inventory.entry.store');

    Route::post('/inventory/exit', [InventoryController::class, 'storeExit'])
        ->name('inventory.exit.store');

    Route::post('/inventory/movement', [InventoryController::class, 'storeMovement'])
        ->name('inventory.movement.store');

    // Alertas
    Route::get('/alerts', [AlertController::class, 'index'])
        ->name('alerts.index');

    Route::post('/alerts/{alert}/resolve', [AlertActionController::class, 'resolve'])
        ->name('alerts.resolve');

    Route::post('/alerts/{alert}/ignore', [AlertActionController::class, 'ignore'])
        ->name('alerts.ignore');

    // Reportes
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    Route::post('/reports/generate', [ReportController::class, 'generate'])
        ->name('reports.generate');
});


// 🔴 SOLO ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Usuarios
    Route::resource('users', UserController::class);

    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('users.toggle-status');

    // Configuración
    Route::resource('categories', CategoryController::class);
    Route::resource('warehouses', WarehouseController::class);
});


require __DIR__.'/auth.php';