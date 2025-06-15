<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerVehicleController;
use App\Http\Controllers\UserVehicleController;
use App\Http\Controllers\UserServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('dashboard.analytics');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Inventory management routes
    Route::resource('inventory', InventoryController::class);
    Route::patch('inventory/{inventoryItem}/adjust-stock', [InventoryController::class, 'adjustStock'])->name('inventory.adjust-stock');
    Route::post('inventory/{inventoryItem}/update-stock', [InventoryController::class, 'updateStock'])->name('inventory.updateStock');
    Route::get('inventory/low-stock', [InventoryController::class, 'lowStock'])->name('inventory.low-stock');

    // Service management routes
    Route::resource('services', ServiceController::class);

    // Customer vehicle routes
    Route::resource('customer-vehicles', CustomerVehicleController::class);
    Route::get('api/customer-vehicles/by-customer', [CustomerVehicleController::class, 'getByCustomer'])->name('customer-vehicles.by-customer');

    // Service request routes
    Route::resource('service-requests', ServiceRequestController::class);
    Route::patch('service-requests/{serviceRequest}/status', [ServiceRequestController::class, 'updateStatus'])->name('service-requests.update-status');

    // Payment routes
    Route::resource('payments', PaymentController::class);
    Route::patch('payments/{payment}/process', [PaymentController::class, 'process'])->name('payments.process');

    // User (Customer) routes
    Route::prefix('user')->name('user.')->group(function () {
        // User vehicles
        Route::resource('vehicles', UserVehicleController::class);
        
        // User services
        Route::resource('services', UserServiceController::class)->only(['index', 'create', 'store', 'show']);
        Route::get('services/{serviceRequest}/payment', [UserServiceController::class, 'payment'])->name('services.payment');
        Route::post('services/{serviceRequest}/payment', [UserServiceController::class, 'processPayment'])->name('services.process-payment');
    });
});

require __DIR__ . '/auth.php';
