<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::middleware(['guest'])->group(function() {

    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/register', [LoginController::class, 'register'])->name('register.index');

    Route::post('login/post', [LoginController::class, 'postlogin'])->name('login.post');
    Route::post('register/post', [LoginController::class, 'postregister'])->name('register.post');
});


Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function() {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/sort/{album_id}', [DashboardController::class, 'sort'])->name('dashboard.sort');

    // Album
    Route::get('/album', [DashboardController::class, 'albumview'])->name('album.index');
    Route::post('/album/post', [DashboardController::class, 'albumpost'])->name('album.post');

    // Foto
    Route::get('/foto', [DashboardController::class, 'fotoview'])->name('fotos.index');
    Route::post('/foto/post', [DashboardController::class, 'fotopost'])->name('fotos.post');
    Route::delete('/delete/{id}', [DashboardController::class, 'delete'])->name('delete.potos');
    Route::post('/like/{id}', [DashboardController::class, 'like'])->name('like');

    Route::get('/komentar/{id}',[KomentarController::class, 'index'])->name('komentar');
    Route::post('/komentar/{id}', [KomentarController::class, 'store'])->name('komentar.store');

});


Route::get('/', [IndexController::class, 'index']);
