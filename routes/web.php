<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShiftKerjaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('akun', AkunController::class);
    Route::prefix('keola-absen')->group(function () {
        Route::GET('/', [AbsensiController::class, 'index'])->name('absen.index');
        Route::GET('/create', [AbsensiController::class, 'create'])->name('absen.create');
        Route::get('/simpan/{token}', [AbsensiController::class, 'store'])->name('absen.store');
        Route::POST('/simpan-cuti', [AbsensiController::class, 'Cutistore'])->name('absen.Cutistore');
        Route::GET('/edit/{id}', [AbsensiController::class, 'edit'])->name('absen.edit');
        Route::PUT('/update/{id}', [AbsensiController::class, 'update'])->name('absen.update');
        Route::delete('hapus/{id}', [AbsensiController::class, 'destroy'])->name('absen.destroy');
        Route::get('/absen/download', [AbsensiController::class, 'downloadExcel'])->name('absen.download');
        Route::post('/absen/acc-cuti', [AbsensiController::class, 'accCuti'])->name('absen.accCuti');
        Route::get('/absen/history', [AbsensiController::class, 'history'])->name('absen.history');
        Route::get('/berhasil-absen', [AbsensiController::class, 'AbsenSukses'])->name('absen.sukses');
    });
    Route::prefix('shift')->group(function () {
        Route::GET('/', [ShiftKerjaController::class, 'index'])->name('shift.index');
        Route::GET('/create', [ShiftKerjaController::class, 'create'])->name('shift.create');
        Route::post('/simpan', [ShiftKerjaController::class, 'store'])->name('shift.store');
        Route::POST('/simpan-cuti', [ShiftKerjaController::class, 'Cutistore'])->name('shift.Cutistore');
        Route::GET('/edit/{id}', [ShiftKerjaController::class, 'edit'])->name('shift.edit');
        Route::PUT('/update/{id}', [ShiftKerjaController::class, 'update'])->name('shift.update');
        Route::delete('hapus/{id}', [ShiftKerjaController::class, 'destroy'])->name('shift.destroy');
    });
    Route::prefix('users')->group(function () {
        Route::GET('/edit-profile/{id}', [UserController::class, 'UpdateProfile'])->name('users.update-profile');
        Route::PUT('/update-profile/{id}', [UserController::class, 'update'])->name('users.simpan-profile');
    });
});
