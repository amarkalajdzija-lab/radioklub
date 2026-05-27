<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminClanController;
use App\Http\Controllers\Admin\AdminGalerijaController;
use App\Http\Controllers\Admin\AdminVijestController;
use App\Http\Controllers\Admin\AdminKontaktController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

// ── Frontend ──────────────────────────────────────────────
Route::get('/',               [PageController::class, 'pocetna'])->name('pocetna');
Route::get('/galerija',       [PageController::class, 'galerija'])->name('galerija');
Route::get('/clanovi',        [PageController::class, 'clanovi'])->name('clanovi');
Route::get('/kontakt',        [PageController::class, 'kontakt'])->name('kontakt');
Route::post('/kontakt',       [PageController::class, 'kontaktSalji'])->name('kontakt.salji');
Route::get('/vijesti',        [PageController::class, 'vijesti'])->name('vijesti');
Route::get('/vijesti/{slug}', [PageController::class, 'vijest'])->name('vijest');

// ── Auth ──────────────────────────────────────────────────
Route::get('/admin/login',  [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit')->middleware('guest');
Route::post('/admin/logout',[AuthController::class, 'logout'])->name('admin.logout');

// ── Admin ─────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/',        [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('clanovi',  AdminClanController::class);
    Route::resource('galerija', AdminGalerijaController::class);
    Route::resource('vijesti',  AdminVijestController::class);
    Route::get('kontakt',                 [AdminKontaktController::class, 'index'])->name('kontakt.index');
    Route::patch('kontakt/{id}/procitaj', [AdminKontaktController::class, 'procitaj'])->name('kontakt.procitaj');
    Route::delete('kontakt/{id}',         [AdminKontaktController::class, 'destroy'])->name('kontakt.destroy');
});