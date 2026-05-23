<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProductController, 
    StockController, 
    ReportController, 
    UserController, 
    ShipmentController, 
    AuthController,
    ProfileController,
    ForecastController,
    GroqController
};

// Auth Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [\App\Http\Controllers\Auth\PasswordController::class, 'update'])->name('password.update');

    // Admin Only
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Reports (Admin & Manager)
    Route::middleware('role:admin,manager')->prefix('reports')->name('reports.')->group(function () {
        Route::get('mutation', [ReportController::class, 'mutation'])->name('mutation');
        Route::get('stock', [ReportController::class, 'stock'])->name('stock');
        Route::get('forecast', [ForecastController::class, 'index'])->name('forecast');
        Route::post('forecast/analyze', [GroqController::class, 'analyze'])->name('forecast.analyze');
    });

    // Products (Read-Only for Staf, Full for Admin & Manager)
    Route::middleware('role:admin,staf,manager')->group(function () {
        Route::resource('products', ProductController::class)->only(['index']);
    });

    // Products & Stock (Write Access for Admin & Manager)
    Route::middleware('role:admin,manager')->group(function () {
        Route::resource('products', ProductController::class)->except(['index']);
        Route::post('stock/update/{product}', [StockController::class, 'update'])->name('stock.update');
    });

    // Shipments (All Roles for Index, Admin/Staf for CRUD)
    Route::get('shipments', [ShipmentController::class, 'index'])->name('shipments.index');
    Route::middleware('role:admin,staf')->group(function () {
        Route::resource('shipments', ShipmentController::class)->except(['index', 'show']);
    });
});