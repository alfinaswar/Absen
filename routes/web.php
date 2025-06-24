<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisCutiController;
use App\Http\Controllers\MasterPerusahaanController;
use App\Http\Controllers\MasterStatusPegawaiController;
use App\Http\Controllers\OverTimeController;
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
Route::get('provinces', [DependantDropdownController::class, 'provinces'])->name('provinces');
Route::get('cities', [DependantDropdownController::class, 'cities'])->name('cities');
Route::get('districts', [DependantDropdownController::class, 'districts'])->name('districts');
Route::get('villages', [DependantDropdownController::class, 'villages'])->name('villages');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('akun', AkunController::class);
    Route::resource('master-status-pegawai', MasterStatusPegawaiController::class);

    Route::prefix('keola-absen')->group(function () {
        Route::GET('/', [AbsensiController::class, 'index'])->name('absen.index');
        Route::GET('/create', [AbsensiController::class, 'create'])->name('absen.create');
        Route::POST('/simpan-absen', [AbsensiController::class, 'store'])->name('absen.store');
        Route::POST('/simpan-cuti', [AbsensiController::class, 'Cutistore'])->name('absen.Cutistore');
        Route::GET('/edit/{id}', [AbsensiController::class, 'edit'])->name('absen.edit');
        Route::PUT('/update/{id}', [AbsensiController::class, 'update'])->name('absen.update');
        Route::delete('hapus/{id}', [AbsensiController::class, 'destroy'])->name('absen.destroy');
        Route::get('/absen/download', [AbsensiController::class, 'download'])->name('absen.download');
        Route::post('/absen/acc-cuti', [AbsensiController::class, 'accCuti'])->name('absen.accCuti');
        Route::get('/absen/history', [AbsensiController::class, 'history'])->name('absen.history');
        Route::get('/berhasil-absen', [AbsensiController::class, 'AbsenSukses'])->name('absen.sukses');
        // mobile
        Route::get('/absen', [AbsensiController::class, 'PageAbsen'])->name('absen.PageAbsen');
        Route::get('/history-absen', [AbsensiController::class, 'historyMobile'])->name('absen.RiwayatAbsen');
        Route::get('/time-off', [AbsensiController::class, 'TimeOff'])->name('absen.TimeOff');
        Route::get('/form-time-off', [AbsensiController::class, 'FormCuti'])->name('absen.formCuti');
        Route::POST('/store-time-off', [AbsensiController::class, 'StoreCuti'])->name('absen.SimpanCuti');
        Route::get('/absensi/filter/{bulan}', [AbsensiController::class, 'filter'])->name('absen.filterbulan');
        Route::get('/overtime', [AbsensiController::class, 'OverTime'])->name('absen.over-time');
        Route::POST('/store-time-off', [AbsensiController::class, 'StoreLembur'])->name('absen.SimpanLembur');
    });
    Route::prefix('shift')->group(function () {
        Route::GET('/', [ShiftKerjaController::class, 'index'])->name('shift.index');
        Route::GET('/create', [ShiftKerjaController::class, 'create'])->name('shift.create');
        Route::post('/simpan', [ShiftKerjaController::class, 'store'])->name('shift.store');
        Route::POST('/simpan-cuti', [ShiftKerjaController::class, 'Cutistore'])->name('shift.Cutistore');
        Route::GET('/edit/{id}', [ShiftKerjaController::class, 'edit'])->name('shift.edit');
        Route::PUT('/update/{id}', [ShiftKerjaController::class, 'update'])->name('shift.update');
        Route::delete('/hapus/{id}', [ShiftKerjaController::class, 'destroy'])->name('shift.destroy');
    });
    Route::prefix('monitoring-lembur')->group(function () {
        Route::GET('/', [OverTimeController::class, 'index'])->name('ot.index');
        Route::GET('/create', [OverTimeController::class, 'create'])->name('ot.create');
        Route::post('/simpan', [OverTimeController::class, 'store'])->name('ot.store');
        Route::GET('/simpan-lembur/{id}', [OverTimeController::class, 'storeLembur'])->name('ot.acc');
        Route::GET('/edit/{id}', [OverTimeController::class, 'edit'])->name('ot.edit');
        Route::PUT('/update/{id}', [OverTimeController::class, 'update'])->name('ot.update');
        Route::delete('/hapus/{id}', [OverTimeController::class, 'destroy'])->name('ot.destroy');
    });
    Route::prefix('master-cuti')->group(function () {
        Route::GET('/', [JenisCutiController::class, 'index'])->name('cuti.index');
        Route::GET('/create', [JenisCutiController::class, 'create'])->name('cuti.create');
        Route::post('/simpan', [JenisCutiController::class, 'store'])->name('cuti.store');
        Route::POST('/simpan-cuti', [JenisCutiController::class, 'Cutistore'])->name('cuti.Cutistore');
        Route::GET('/edit/{id}', [JenisCutiController::class, 'edit'])->name('cuti.edit');
        Route::PUT('/update/{id}', [JenisCutiController::class, 'update'])->name('cuti.update');
        Route::delete('/hapus/{id}', [JenisCutiController::class, 'destroy'])->name('cuti.destroy');
    });
    Route::prefix('users')->group(function () {
        Route::GET('/edit-profile/{id}', [UserController::class, 'UpdateProfile'])->name('users.update-profile');
        Route::PUT('/update-profile/{id}', [UserController::class, 'update'])->name('users.simpan-profile');
    });
    Route::prefix('master-perusahaan')->group(function () {
        Route::GET('/', [MasterPerusahaanController::class, 'index'])->name('mp.index');
        Route::GET('/create', [MasterPerusahaanController::class, 'create'])->name('mp.create');
        Route::POST('/simpan', [MasterPerusahaanController::class, 'store'])->name('mp.store');
        Route::GET('/edit/{id}', [MasterPerusahaanController::class, 'edit'])->name('mp.edit');
        Route::PUT('/update/{id}', [MasterPerusahaanController::class, 'update'])->name('mp.update');
        Route::delete('hapus/{id}', [MasterPerusahaanController::class, 'destroy'])->name('mp.destroy');
    });
});
