<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\KategoriController;

// Default arahkan ke daftar surat
Route::get('/', [SuratController::class, 'index'])->name('surat.index');

// CRUD Surat
Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');
Route::get('/surat/{surat}', [SuratController::class, 'show'])->name('surat.show');
Route::get('/surat/{surat}/download', [SuratController::class, 'download'])->name('surat.download');
Route::delete('/surat/{surat}', [SuratController::class, 'destroy'])->name('surat.destroy');

// Tambahan untuk edit & update
Route::get('/surat/{surat}/edit', [SuratController::class, 'edit'])->name('surat.edit');
Route::put('/surat/{surat}', [SuratController::class, 'update'])->name('surat.update');

// CRUD Keterangan
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

Route::view('/about', 'about')->name('about');
