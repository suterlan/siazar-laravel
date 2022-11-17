<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KlasifikasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PanggilanController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\SuratBaruController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\UserController;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){return view('index', ['title'=>'Dashboard']);})->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// ================= GROUP AUTENTIKASI ==========================
Route::group(['middleware' => ['auth']], function () {

    // ======================= ROUTE DASHBOARD =======================
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // route manipulasi akun user
    Route::resource('/dashboard/user', UserController::class)->except(['create', 'show'])->middleware('admin');;

    // Route klasifikasi
    Route::resource('/dashboard/klasifikasi', KlasifikasiController::class)->except(['create', 'show'])->middleware('admin');

        // ROUTE untuk membuat no surat otomatis
    Route::get('/getCodeKlasifikasi', [SuratKeluarController::class, 'getCodeKlasifikasi']);

    // Route surat keluar (semua surat)
    Route::get('/dashboard/surat', [SuratKeluarController::class,'index']);
    Route::get('/dashboard/suratkeluar/{jenis}', [SuratKeluarController::class,'create']);

    // Route Surat Keluar (Penerimaan)
    Route::resource('/dashboard/surat/penerimaan', PenerimaanController::class);
    Route::get('/dashboard/surat/penerimaan/cetak/{penerimaan}', [PenerimaanController::class, 'cetak']);
    Route::get('/dashboard/surat/penerimaan/download/{penerimaan}', [PenerimaanController::class, 'download']);

    // Route Surat Keluar (Panggilan)
    Route::resource('/dashboard/surat/panggilan', PanggilanController::class);
    Route::get('/dashboard/surat/panggilan/cetak/{panggilan}', [PanggilanController::class, 'cetak']);
    Route::get('/dashboard/surat/panggilan/download/{panggilan}', [PanggilanController::class, 'download']);

    // Route surat keluar (mutasi siswa)
    Route::resource('/dashboard/surat/mutasi', MutasiController::class);

    // Route surat masuk
    Route::resource('/dashboard/suratmasuk', SuratMasukController::class);

});
