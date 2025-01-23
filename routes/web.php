<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KoderekeningController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\SubkegiatanController;
use App\Http\Controllers\RekeningdetailController;
use App\Http\Controllers\UpController;
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
    Route::get('/koderekening/{kode_rekening}/hapus', [KodeRekeningController::class, 'hapus']);
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
    Route::post('/program/update', [programController::class, 'update']);
    Route::get('/program/edit/{kode_program}', [programController::class, 'edit']);
    Route::get('/program/{kode_program}/hapus', [programController::class, 'hapus']);
    //Kegiatan
    Route::get('/kegiatan/view', [KegiatanController::class, 'view']);
    Route::get('/kegiatan/create', [KegiatanController::class, 'create']);
    Route::post('/kegiatan/store', [KegiatanController::class, 'store']);
    Route::post('/kegiatan/update', [KegiatanController::class, 'update']);
    Route::get('/kegiatan/edit/{kode_kegiatan}', [KegiatanController::class, 'edit']);
    Route::get('/kegiatan/{kode_kegiatan}/hapus', [KegiatanController::class, 'hapus']);
    //Sub_kegiatan
    Route::get('/sub_kegiatan/view', [SubkegiatanController::class, 'view']);
    Route::get('/sub_kegiatan/create', [SubkegiatanController::class, 'create']);
    Route::post('/sub_kegiatan/store', [SubkegiatanController::class, 'store']);
    Route::post('/sub_kegiatan/update', [SubkegiatanController::class, 'update']);
    Route::get('/sub_kegiatan/edit/{kode_sub_kegiatan}', [SubkegiatanController::class, 'edit']);
    Route::get('/sub_kegiatan/{kode_sub_kegiatan}/hapus', [SubkegiatanController::class, 'hapus']);
    Route::get('/sub_kegiatan/kode_rekening/{kode_sub_kegiatan}', [SubkegiatanController::class, 'kode_rekening']);
    Route::post('/sub_kegiatan/subdet/store', [SubkegiatanController::class, 'storedetail']);
    Route::get('/sub_kegiatan/editsubdet/{kode_sub_kegiatan}', [SubkegiatanController::class, 'editdetail']);
    Route::post('/sub_kegiatan/updatesubdet', [SubkegiatanController::class, 'updatedetail']);
    Route::get('/sub_kegiatan/{kode_sub_kegiatan}/hapussubdet', [SubkegiatanController::class, 'hapussubdet']);
        //Rekening Detail
        Route::get('/rekeningdetail/{id_subdet}', [RekeningdetailController::class, 'view']);
        Route::post('/rekeningdetail/store', [RekeningdetailController::class, 'store']);
        Route::get('/rekeningdetail/edit/{id_rekdet}', [RekeningdetailController::class, 'edit']);
        Route::post('/rekeningdetail/update', [RekeningdetailController::class, 'update']);
    //Uang Pelimpahan
    Route::get('/up/view', [UpController::class, 'view']);
    Route::get('/up/create', [UpController::class, 'create']);
    Route::post('/up/store', [UpController::class, 'store']);
    Route::post('/up/update', [UpController::class, 'update']);
    Route::get('/up/edit/{id_up}', [UpController::class, 'edit']);
    Route::get('/up/{id_up}/hapus', [UpController::class, 'hapus']);
    Route::get('/up/verifikasi/{id_up}', [UpController::class, 'lock']);

});

//Akses Level User



