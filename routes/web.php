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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('warehouses', WarehouseController::class);

    Route::get('/movements', [MovementController::class, 'index'])
        ->name('movements.index');

    Route::resource('users', UserController::class);
    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('users.toggle-status');


      Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');  
        //REPORTE

        Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    Route::post('/reports/generate', [ReportController::class, 'generate'])
        ->name('reports.generate');


   // INVENTARIO
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

    // ENTRADA (POST)
    Route::post('/inventory/entry', [InventoryController::class, 'storeEntry'])->name('inventory.entry.store');

    // SALIDA (POST)
    Route::post('/inventory/exit', [InventoryController::class, 'storeExit'])->name('inventory.exit.store');

    // Inventario AJAX
    Route::post('/inventory/movement', [InventoryController::class, 'storeMovement'])
    ->name('inventory.movement.store');
    Route::get('/alerts', [AlertController::class, 'index'])->name('alerts.index');

    Route::post('/alerts/{alert}/resolve', [AlertActionController::class, 'resolve'])
        ->name('alerts.resolve');

    Route::post('/alerts/{alert}/ignore', [AlertActionController::class, 'ignore'])
        ->name('alerts.ignore');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});


require __DIR__.'/auth.php';
