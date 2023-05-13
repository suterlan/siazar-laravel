<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PanggilanController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WilayahIndonesiaController;
use App\Http\Controllers\website\PendaftaranController;
use App\Http\Controllers\website\WebController;

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

// Route::group(['middleware' => ['guest']], function () {
// Route front website
    Route::get('/', [WebController::class, 'index']);
    // Route Jurusan
    Route::get('/jurusan', [WebController::class, 'jurusan'])->name('jurusan');
    Route::get('/pendidik', [WebController::class, 'pendidik'])->name('pendidik');
    Route::get('/galeri', [WebController::class, 'galeri'])->name('galeri');
    Route::get('/blog', [WebController::class, 'blog'])->name('blog');
    Route::get('/blog/{post:slug}', [WebController::class, 'singleBlog']);
    Route::get('/blog/categories/{category:slug}', [WebController::class, 'blogCategories']);
    Route::get('/tentang', [WebController::class, 'tentang'])->name('tentang');
    Route::get('/kontak', [WebController::class, 'kontak'])->name('kontak');

    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran');
    // Route untuk mengambil data kabupaten dengan javascript (plugin laravolt)
        Route::get('/pendaftaran/getKabupaten', [PendaftaranController::class, 'getKabupaten'])->name('kabupaten');
        Route::get('/pendaftaran/getKecamatan', [PendaftaranController::class, 'getKecamatan'])->name('kecamatan');
        Route::get('/pendaftaran/getKelurahan', [PendaftaranController::class, 'getKelurahan'])->name('kelurahan');
    // end front
    Route::resource('/pesan', PesanController::class)->only(['store']);
// });

// ROUTE LOGIN TO DASHBOARD ADMIN PANEL
Route::get('/panel', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// ================= GROUP AUTENTIKASI ==========================
Route::group(['middleware' => ['auth']], function () {

    // ======================= ROUTE DASHBOARD =======================
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Route PPDB
    Route::get('/dashboard/ppdb', [PPDBController::class, 'index']);
    Route::get('/dashboard/ppdb/registrasi-step1', [PPDBController::class, 'registration1']);
    Route::post('/dashboard/ppdb/registrasi-step1', [PPDBController::class, 'postRegistration1']);
    Route::get('/dashboard/ppdb/registrasi-step2', [PPDBController::class, 'registration2']);
    Route::post('/dashboard/ppdb/registrasi-step2', [PPDBController::class, 'postRegistration2']);
    Route::get('/dashboard/ppdb/registrasi-step3', [PPDBController::class, 'registration3']);
    Route::post('/dashboard/ppdb/registrasi-step3', [PPDBController::class, 'postRegistration3']);
    Route::get('/dashboard/ppdb/registrasi-step4', [PPDBController::class, 'registration4']);
    Route::post('/dashboard/ppdb/registrasi-finish', [PPDBController::class, 'finishRegistration']);
    // route approve ppdb
    Route::post('/dashboard/ppdb/approve', [PPDBController::class, 'approve']);
    Route::get('/dashboard/ppdb/detail/{id}', [PPDBController::class, 'show']);
    Route::get('/dashboard/ppdb/edit/{id}', [PPDBController::class, 'edit']);
    Route::post('/dashboard/ppdb/update', [PPDBController::class, 'update']);
    Route::get('/dashboard/ppdb/delete/{id}', [PPDBController::class, 'delete']);
    Route::delete('/dashboard/ppdb/delete-all', [PPDBController::class, 'deleteAll']);
    // Route untuk mengambil data wilayah dengan javascript (plugin laravolt)
    Route::get('/getKabupaten', [WilayahIndonesiaController::class, 'getKabupaten'])->name('kabupaten');
    Route::get('/getKecamatan', [WilayahIndonesiaController::class, 'getKecamatan'])->name('kecamatan');
    Route::get('/getKelurahan', [WilayahIndonesiaController::class, 'getKelurahan'])->name('kelurahan');

    // Route Siswa
    Route::resource('/dashboard/siswa', SiswaController::class)->except(['store', 'create'])->middleware('admin');

    // Route Jurusan
    Route::resource('/dashboard/jurusan', JurusanController::class)->except(['create', 'show'])->middleware('admin');
    // route manipulasi akun user
    Route::resource('/dashboard/user', UserController::class)->except(['create', 'show'])->middleware('admin');

    // Route Kelas
    Route::resource('/dashboard/kelas', KelasController::class);

    Route::get('/dashboard/user/ubahrole', [UserController::class, 'changeRole']);

    // Route klasifikasi
    Route::resource('/dashboard/klasifikasi', KlasifikasiController::class)->except(['create', 'show'])->middleware('admin');

        // ROUTE untuk membuat no surat otomatis
    Route::get('/getCodeKlasifikasi', [SuratKeluarController::class, 'getCodeKlasifikasi']);

    // Route surat keluar (semua surat)
    Route::get('/dashboard/suratkeluar', [SuratKeluarController::class,'index']);
    Route::get('/dashboard/surat/{jenis}', [SuratKeluarController::class,'create']);

    // Route Surat Keluar (Penerimaan)
    Route::resource('/dashboard/suratkeluar/penerimaan', PenerimaanController::class);
    Route::get('/dashboard/suratkeluar/penerimaan/cetak/{penerimaan}', [PenerimaanController::class, 'cetak']);
    Route::get('/dashboard/suratkeluar/penerimaan/download/{penerimaan}', [PenerimaanController::class, 'download']);

    // Route Surat Keluar (Panggilan)
    Route::resource('/dashboard/suratkeluar/panggilan', PanggilanController::class);
    Route::get('/dashboard/suratkeluar/panggilan/cetak/{panggilan}', [PanggilanController::class, 'cetak']);
    Route::get('/dashboard/suratkeluar/panggilan/download/{panggilan}', [PanggilanController::class, 'download']);

    // Route surat keluar (mutasi siswa)
    Route::resource('/dashboard/suratkeluar/mutasi', MutasiController::class);
    Route::get('/dashboard/suratkeluar/mutasi/cetak/{mutasi}', [MutasiController::class, 'cetak']);
    Route::get('/dashboard/suratkeluar/mutasi/download/{mutasi}', [MutasiController::class, 'download']);

    // Route surat masuk
    Route::resource('/dashboard/suratmasuk', SuratMasukController::class);

    // Route Setting website
    Route::get('/dashboard/settings-iklan', [IklanController::class, 'index']);
    Route::put('/dashboard/settings-iklan/{iklan}', [IklanController::class, 'update']);

    // Route Galeri
    Route::get('dashboard/galeri/download/{galeri}', [GaleriController::class, 'download']);
    Route::resource('/dashboard/galeri', GaleriController::class);

    // Route Setting Profile Sekolah
    Route::get('/dashboard/sekolah', [SekolahController::class, 'index'])->name('sekolah');
    Route::put('/dashboard/sekolah/{sekolah}', [SekolahController::class, 'update']);
    // Route Setting Tentang
    Route::get('/dashboard/settings-tentang', [TentangController::class, 'index']);
    Route::put('/dashboard/settings-tentang/{tentang}', [TentangController::class, 'update']);

    // Route Category Post
    Route::get('/dashboard/category/setSlug', [CategoryController::class, 'setSlug']);
    Route::get('/dashboard/category/edit/{category}', [CategoryController::class, 'edit']);
    Route::post('/dashboard/category', [CategoryController::class, 'store']);
    Route::put('/dashboard/category/{category}', [CategoryController::class, 'update']);
    Route::delete('/dashboard/category/{category}', [CategoryController::class, 'destroy']);
    // Route Post
    Route::get('/dashboard/posts/setSlug', [PostController::class, 'setSlug']);
    Route::resource('/dashboard/posts', PostController::class);

    Route::get('/dashboard/pesan/tulis-email/{id}', [PesanController::class, 'TulisEmail']);
    // Route::get('/dashboard/pesan/kirim-email', [PesanController::class, 'KirimEmail']);
    Route::post('/dashboard/pesan/kirim-email', [PesanController::class, 'KirimEmail']);

    Route::delete('/dashboard/pesan/delete-all', [PesanController::class, 'deleteAll']);
    Route::resource('/dashboard/pesan', PesanController::class);
});
