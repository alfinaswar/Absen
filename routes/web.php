<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
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
    Route::prefix('keola-absen')->group(function () {
        Route::GET('/', [AbsensiController::class, 'index'])->name('absen.index');
        Route::GET('/create', [AbsensiController::class, 'create'])->name('absen.create');
        Route::get('/simpan', [AbsensiController::class, 'store'])->name('absen.store');
        Route::POST('/simpan-cuti', [AbsensiController::class, 'Cutistore'])->name('absen.Cutistore');
        Route::GET('/edit/{id}', [AbsensiController::class, 'edit'])->name('absen.edit');
        Route::PUT('/update/{id}', [AbsensiController::class, 'update'])->name('absen.update');
        Route::delete('hapus/{id}', [AbsensiController::class, 'destroy'])->name('absen.destroy');
        Route::get('/absen/download', [AbsensiController::class, 'downloadPDF'])->name('absen.download');
        Route::post('/absen/acc-cuti', [AbsensiController::class, 'accCuti'])->name('absen.accCuti');
        Route::get('/absen/history', [AbsensiController::class, 'history'])->name('absen.history');
    });
});
