<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::controller(RedirectController::class)->group(function () {
    Route::get('/', 'redirectHome')->name('redirectHome');
    Route::get('/listUsers', 'redirectListUsers')->name('redirectListUsers')->middleware('admin');
    Route::get('/login-admin', 'redirectLoginAdmin')->name('redirectLoginAdmin');
    Route::get('/publication/create', 'redirectCreatePublication')->name('redirectCreatePublication');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/registro', 'redirectRegister')->name('redirectRegister');
    Route::post('/criarRegistro', 'createRegister')->name('createRegister');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('showLogin');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

//publication
Route::controller(PublicationController::class)->group(function () {
    Route::post('/publication/create-post', 'createPublication')->name('createPublication');
});

// admin
Route::controller(LoginController::class)->group(function () {
    Route::get('/admin/login', 'showAdminLogin')->name('showAdminLogin');
    Route::post('/admin/login-post', 'adminLogin')->name('adminLogin');
});