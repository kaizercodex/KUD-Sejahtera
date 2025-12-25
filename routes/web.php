<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Datamaster\UserController;
use App\Http\Controllers\Datamaster\RoleController;

Route::get('/', function () {
    return view('landing_page.index');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected Routes
Route::middleware('auth')->group(function () {
    // Dashboard - Accessible by all authenticated users
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
    
    Route::prefix('datamaster')->group(function () {
        // User Management - Only Admin can access
        Route::middleware('role:admin|super admin')->group(function () {
            Route::get('/user', [UserController::class, 'index'])->name('user.index');
            Route::get('/user/roles', [UserController::class, 'getRoles'])->name('user.roles');
            Route::get('/user/datatable', [UserController::class, 'getDatatablesUser'])->name('user.datatable');
            Route::post('/user', [UserController::class, 'store'])->name('user.store');
            Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
            Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
            Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        });

        Route::middleware('role:super admin')->group(function () {
            Route::get('/role', [RoleController::class, 'index'])->name('role.index');
            Route::get('/role/permissions', [RoleController::class, 'getPermissions'])->name('role.permissions');
            Route::get('/role/datatable', [RoleController::class, 'getDatatablesRole'])->name('role.datatable');
            Route::post('/role', [RoleController::class, 'store'])->name('role.store');
            Route::get('/role/{id}', [RoleController::class, 'show'])->name('role.show');
            Route::put('/role/{id}', [RoleController::class, 'update'])->name('role.update');
            Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
        });
    });
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
