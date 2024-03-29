<?php

use App\Models\Kehadiran;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PertemuanController;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\DashboardSiswaController;
use App\Http\Controllers\SarprasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('sekolah.index');
    Route::get('/sekolah/edit/{sekolah}', [DashboardController::class, 'edit'])->name('sekolah.edit');
    Route::put('/sekolah/edit/{sekolah}', [DashboardController::class, 'update'])->name('sekolah.update');
    Route::get('/guru', [DashboardGuruController::class, 'index'])->name('guru.index');
    Route::get('/siswa', [DashboardSiswaController::class, 'index'])->name('siswa.index');
    Route::get('/user/create', [DashboardGuruController::class, 'create'])->name('user.create');
    Route::post('/user/create', [DashboardGuruController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{user}', [DashboardGuruController::class, 'edit'])->name('user.edit');
    Route::put('/user/edit/{user}', [DashboardGuruController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{user}', [DashboardGuruController::class, 'destroy'])->name('user.destroy');
    Route::get('/kehadiran', [KehadiranController::class, 'index'])->name('kehadiran.index');
    Route::get('/kehadiran/create', [KehadiranController::class, 'create'])->name('kehadiran.create');
    Route::post('/kehadiran/create', [KehadiranController::class, 'store'])->name('kehadiran.store');
    Route::get('/kehadiran/edit/{kehadiran}', [KehadiranController::class, 'edit'])->name('kehadiran.edit');
    Route::put('/kehadiran/edit/{kehadiran}', [KehadiranController::class, 'update'])->name('kehadiran.update');
    Route::delete('/kehadiran/delete/{kehadiran}', [KehadiranController::class, 'destroy'])->name('kehadiran.destroy');
    Route::get('/pertemuan', [PertemuanController::class, 'index'])->name('pertemuan.index');
    Route::get('/pertemuan/create', [PertemuanController::class, 'create'])->name('pertemuan.create');
    Route::post('/pertemuan/create', [PertemuanController::class, 'store'])->name('pertemuan.store');
    Route::put('/pertemuan/edit/{pertemuan}', [PertemuanController::class, 'update'])->name('pertemuan.update');
    Route::get('/pertemuan/edit/{pertemuan}', [PertemuanController::class, 'edit'])->name('pertemuan.edit');
    Route::delete('/pertemuan/delete/{pertemuan}', [PertemuanController::class, 'destroy'])->name('pertemuan.destroy');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/sarpras', [SarprasController::class, 'index'])->name('sarpras.index');
    Route::get('/sarpras/create', [SarprasController::class, 'create'])->name('sarpras.create');
    Route::post('/sarpras/create', [SarprasController::class, 'store'])->name('sarpras.store');
    Route::get('/sarpras/edit/{sarpras}', [SarprasController::class, 'edit'])->name('sarpras.edit');
    Route::put('/sarpras/edit/{sarpras}', [SarprasController::class, 'update'])->name('sarpras.update');
    Route::delete('/sarpras/destroy/{sarpras}', [SarprasController::class, 'destroy'])->name('sarpras.destroy');
});

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest')->name('login.store');
