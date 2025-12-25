<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Datamaster\UserController;
use App\Http\Controllers\Datamaster\RoleController;
use App\Http\Controllers\Datamaster\PesertaPlasmaController;
use App\Http\Controllers\Datamaster\PetaniController;
use App\Http\Controllers\Datamaster\KelompokController;
use App\Http\Controllers\Datamaster\BlokController;
use App\Http\Controllers\Datamaster\LahanController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\Api\Select2\Select2HandlerController;

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
    
    Route::prefix('api/select2')->group(function () {
        Route::get('/kelompok', [Select2HandlerController::class, 'getDataKelompok'])->name('api.select2.kelompok');
        Route::get('/peserta', [Select2HandlerController::class, 'getDataPeserta'])->name('api.select2.peserta');
        Route::get('/petani', [Select2HandlerController::class, 'getDataPetani'])->name('api.select2.petani');
        Route::get('/blok', [Select2HandlerController::class, 'getDataBlok'])->name('api.select2.blok');
    });


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

        Route::middleware('role:admin|super admin|operator')->group(function () {
            Route::get('/peserta-plasma', [PesertaPlasmaController::class, 'index'])->name('peserta-plasma.index');
            Route::get('/peserta-plasma/datatable', [PesertaPlasmaController::class, 'getDatatablesPesertaPlasma'])->name('peserta-plasma.datatable');
            Route::post('/peserta-plasma', [PesertaPlasmaController::class, 'store'])->name('peserta-plasma.store');
            Route::get('/peserta-plasma/{id}', [PesertaPlasmaController::class, 'show'])->name('peserta-plasma.show');
            Route::post('/peserta-plasma/{id}', [PesertaPlasmaController::class, 'update'])->name('peserta-plasma.update');
            Route::delete('/peserta-plasma/{id}', [PesertaPlasmaController::class, 'destroy'])->name('peserta-plasma.destroy');
        });

        Route::middleware('role:admin|super admin|operator')->group(function () {
            Route::get('/petani', [PetaniController::class, 'index'])->name('petani.index');
            Route::get('/petani/datatable', [PetaniController::class, 'getDatatablesPetani'])->name('petani.datatable');
            Route::post('/petani', [PetaniController::class, 'store'])->name('petani.store');
            Route::get('/petani/{id}', [PetaniController::class, 'show'])->name('petani.show');
            Route::put('/petani/{id}', [PetaniController::class, 'update'])->name('petani.update');
            Route::delete('/petani/{id}', [PetaniController::class, 'destroy'])->name('petani.destroy');
        });

        Route::middleware('role:admin|super admin|operator')->group(function () {
            Route::get('/kelompok', [KelompokController::class, 'index'])->name('kelompok.index');
            Route::get('/kelompok/datatable', [KelompokController::class, 'getDatatablesKelompok'])->name('kelompok.datatable');
            Route::post('/kelompok', [KelompokController::class, 'store'])->name('kelompok.store');
            Route::get('/kelompok/{id}', [KelompokController::class, 'show'])->name('kelompok.show');
            Route::put('/kelompok/{id}', [KelompokController::class, 'update'])->name('kelompok.update');
            Route::delete('/kelompok/{id}', [KelompokController::class, 'destroy'])->name('kelompok.destroy');
        });

        Route::middleware('role:admin|super admin|operator')->group(function () {
            Route::get('/blok', [BlokController::class, 'index'])->name('blok.index');
            Route::get('/blok/datatable', [BlokController::class, 'getDatatablesBlok'])->name('blok.datatable');
            Route::post('/blok', [BlokController::class, 'store'])->name('blok.store');
            Route::get('/blok/{id}', [BlokController::class, 'show'])->name('blok.show');
            Route::put('/blok/{id}', [BlokController::class, 'update'])->name('blok.update');
            Route::delete('/blok/{id}', [BlokController::class, 'destroy'])->name('blok.destroy');
        });

        Route::middleware('role:admin|super admin|operator')->group(function () {
            Route::get('/lahan', [LahanController::class, 'index'])->name('lahan.index');
            Route::get('/lahan/datatable', [LahanController::class, 'getDatatablesLahan'])->name('lahan.datatable');
            Route::post('/lahan', [LahanController::class, 'store'])->name('lahan.store');
            Route::get('/lahan/{id}', [LahanController::class, 'show'])->name('lahan.show');
            Route::put('/lahan/{id}', [LahanController::class, 'update'])->name('lahan.update');
            Route::delete('/lahan/{id}', [LahanController::class, 'destroy'])->name('lahan.destroy');
        });

        Route::middleware('role:admin|super admin|operator')->group(function () {
            Route::get('/simpanan', [SimpananController::class, 'index'])->name('simpanan.index');
            Route::get('/simpanan/datatable', [SimpananController::class, 'getDatatablesSimpanan'])->name('simpanan.datatable');
            Route::post('/simpanan', [SimpananController::class, 'store'])->name('simpanan.store');
            Route::get('/simpanan/{id}', [SimpananController::class, 'show'])->name('simpanan.show');
            Route::put('/simpanan/{id}', [SimpananController::class, 'update'])->name('simpanan.update');
            Route::delete('/simpanan/{id}', [SimpananController::class, 'destroy'])->name('simpanan.destroy');
        });
    });
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
