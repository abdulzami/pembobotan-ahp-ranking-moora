<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\HasilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PembobtanAHPController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Models\SubKriteria;

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

Route::get('/',[WelcomeController::class, 'index'])->name('home');

Route::get('/kriteria',[KriteriaController::class, 'index'])->name('kriteria');
Route::get('/tambah-kriteria',[KriteriaController::class, 'create'])->name('tambah-kriteria');
Route::post('/tambah-kriteria/store',[KriteriaController::class, 'store'])->name('tambah-kriteria.store');
Route::get('/ubah-kriteria/{id}',[KriteriaController::class, 'edit'])->name('ubah-kriteria');
Route::put('/ubah-kriteria/{id}/update',[KriteriaController::class, 'update'])->name('ubah-kriteria.update');
Route::get('/kriteria/hapus/{id}',[KriteriaController::class,'destroy'])->name('hapus-kriteria');

Route::get('/subkriteria',[SubKriteriaController::class, 'index'])->name('subkriteria');
Route::get('/tambah-subkriteria',[SubKriteriaController::class, 'create'])->name('tambah-subkriteria');
Route::post('/tambah-subkriteria/store',[SubKriteriaController::class, 'store'])->name('tambah-subkriteria.store');
Route::get('/ubah-subkriteria/{id}',[SubKriteriaController::class,'edit'])->name('ubah-sk');
Route::put('/ubah-subkriteria/{id}',[SubKriteriaController::class,'update'])->name('ubah-sk.update');
Route::get('/subkriteria/hapus/{id}',[SubKriteriaController::class,'destroy'])->name('hapus-sk');

Route::get('/alternatif',[AlternatifController::class,'index'])->name('alternatif');
Route::get('/tambah-alternatif',[AlternatifController::class,'create'])->name('tambah-alternatif');
Route::post('/tambah-alternatif/store',[AlternatifController::class,'store'])->name('tambah-alternatif.store');
Route::get('/ubah-alternatif/{id}',[AlternatifController::class,'edit'])->name('ubah-alternatif');
Route::put('/ubah-alternatif/{id}/update',[AlternatifController::class,'update'])->name('ubah-alternatif.update');
Route::get('/alternatif/hapus/{id}',[AlternatifController::class,'destroy'])->name('hapus-alternatif');

Route::get('/penilaian',[PenilaianController::class,'index'])->name('penilaian');
Route::get('/tambah-penilaian/{id}',[PenilaianController::class,'create'])->name('tambah-penilaian');
Route::post('/tambah-penilaian/{id}/store',[PenilaianController::class,'store'])->name('tambah-penilaian.store');
Route::get('/ubah-penilaian/{id}',[PenilaianController::class,'edit'])->name('ubah-penilaian');
Route::put('/ubah-penilaian/{id}/update',[PenilaianController::class,'update'])->name('ubah-penilaian.update');

Route::get('/hasil-perhitungan',[HasilController::class,'index'])->name('hasil');

Route::get('/pembobotan-ahp',[PembobtanAHPController::class,'index'])->name('pembobotan-ahp');
Route::POST('/pembobotan-ahp',[PembobtanAHPController::class,'generate'])->name('pembobotan-ahp');