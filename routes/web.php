<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KoderekeningController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PejabatpelaksanaController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('auth.login');
});

//Proses Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login_proses', [LoginController::class, 'login_proses']);
Route::get('/logout', [LoginController::class, 'logout']);

//Akses Level Admin
Route::middleware(['auth','admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    //kode rekening
    Route::get('/koderekening_view', [KodeRekeningController::class, 'koderekening_view']);
    Route::get('/koderekening_create', [KodeRekeningController::class, 'koderekening_create']);
    Route::post('/koderekening/store', [KodeRekeningController::class, 'store']);
    Route::get('/koderekening/edit/{kode_rekening}', [KodeRekeningController::class, 'edit']);
    Route::post('/koderekening/update', [KodeRekeningController::class, 'update']);
    Route::get('/koderekening/{id_kdrekening}/hapus', [KodeRekeningController::class, 'hapus']);
    //pejabat pelaksana
    Route::get('/pejabatpelaksana/view', [PejabatpelaksanaController::class, 'view']);
    Route::get('/pejabatpelaksana/edit/{id_pejabat}', [PejabatpelaksanaController::class, 'edit']);
    Route::post('/pejabatpelaksana/update', [PejabatpelaksanaController::class, 'update']);
    //penyedia
    Route::get('/penyedia/view', [PenyediaController::class, 'view']);
    Route::get('/penyedia/create', [PenyediaController::class, 'create']);
    Route::post('/penyedia/store', [PenyediaController::class, 'store']);
    Route::delete('/penyedia/{id_penyedia}/hapus', [PenyediaController::class, 'hapus']);
    Route::get('/penyedia/edit/{id_penyedia}', [PenyediaController::class, 'edit']);
    Route::post('/penyedia/update', [PenyediaController::class, 'update']);
    //User
     Route::get('/user/view', [UsersController::class, 'view']);
     Route::get('/user/create', [UsersController::class, 'create']);
     Route::post('/user/store', [UsersController::class, 'store']);
     Route::get('/user/edit/{id}', [UsersController::class, 'edit']);
     Route::post('/user/update', [UsersController::class, 'update']);
    //program
    Route::get('/program/view', [programController::class, 'view']);
    Route::get('/program/create', [programController::class, 'create']);
    Route::post('/program/store', [programController::class, 'store']);
});

//Akses Level User



