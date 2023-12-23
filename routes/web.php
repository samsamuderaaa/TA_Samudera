<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\KuisonerController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MaskapaiController;
use Illuminate\Support\Facades\Auth;

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



Route::get('/', function () {
    return view('auth/masuk');
})->name('login');
Route::post('/', [AuthController::class, 'proseslogin']);
// Route::get('/masuk', function () {
//     return view('auth/masuk');
// });
// Route::get('/daftar', function () {
//     return view('auth/daftar');
// });


// Route::get('/', function () {
//     return view('dashboard');
// });

Route::middleware(['auth_group'])->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index']);
    
    Route::post('/daftar/proses', [AuthController::class, 'prosesdaftar']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/admin/hapus/{idUser}', [AuthController::class, 'proseshapus']);
    
    Route::get('admin', [adminController::class, 'index']);
    Route::post('admin', [adminController::class, 'store']);
    Route::delete('admin/{id}', [adminController::class, 'destroy']);

    Route::get('kriteria', [KriteriaController::class, 'index']);
    Route::post('kriteria', [KriteriaController::class, 'store']);
    Route::post('kriteria/{id}', [KriteriaController::class, 'update']);

    Route::get('maskapai', [MaskapaiController::class, 'index']);
    Route::post('maskapai', [MaskapaiController::class, 'store']);
    Route::put('maskapai/{id}', [MaskapaiController::class, 'update']);
    Route::delete('maskapai/{id}', [MaskapaiController::class, 'destroy']);
    
    Route::get('kriteria-{id}/sub-kriteria', [SubKriteriaController::class, 'index']);
    Route::post('kriteria-{id}/sub-kriteria', [SubKriteriaController::class, 'store']);
    Route::post('kriteria-{kriteria}/sub-kriteria/{id}', [SubKriteriaController::class, 'update']);
    Route::delete('kriteria-{kriteria}/sub-kriteria/{id}', [SubKriteriaController::class, 'destroy']);
    
    Route::get('data-kuesioner', [KuisonerController::class, 'index']);
    Route::Post('data-kuesioner', [KuisonerController::class, 'qr_code']);
    
    Route::get('perhitungan', [PerhitunganController::class, 'index']);
    
    Route::get('laporan', [LaporanController::class, 'index']);
    Route::post('laporan', [LaporanController::class, 'filter']);
    
});
Route::get('kuesioner', [KuisonerController::class, 'create']);
Route::post('kuesioner', [KuisonerController::class, 'store']);
Route::get('kuesioner/done',function(){
    return view('kuisoner.kuisonerSelesai');
});
Route::get('kuesioner/{id}', [KuisonerController::class, 'show']);
