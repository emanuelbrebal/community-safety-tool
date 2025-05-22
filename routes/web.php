<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\RegisterController;
use Illuminate\Routing\RedirectController as RoutingRedirectController;
use Illuminate\Support\Facades\Route;

Route::controller(RedirectController::class)->group(function () {
    Route::get('/login', 'redirectLoginUser')->name('redirectLoginUser');
    Route::get('/login-admin', 'redirectLoginAdmin')->name('redirectLoginAdmin');
    Route::get('/registro', 'redirectRegister')->name('redirectRegister');
});

Route::controller(RegisterController::class)->group(function () {
    Route::post('/criarRegistro', 'createRegister')->name('createRegister');
});

Route::controller(LoginController::class)->group(function () {    
    Route::post('/login-post', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
    
    // admin
    Route::get('/admin/login', 'showAdminLogin')->name('showAdminLogin');
    Route::post('/admin/login-post', 'adminLogin')->name('adminLogin');
});

//usuários logados
Route::middleware(['loggedUser', 'user'])->group(function () { 
    Route::controller(PublicationController::class)->group(function () {
        Route::post('/publication/create-post', 'createPublication')->name('createPublication');
    });

    Route::controller(RedirectController::class)->group(function () {
        Route::get('/', 'redirectHome')->name('redirectHome');
        Route::get('/publication/create', 'redirectCreatePublication')->name('redirectCreatePublication');
    });
});

Route::middleware(['loggedAdmin', 'admin'])->group(function() {
    Route::controller(RedirectController::class)->group(function () {
        Route::get('/listUsers', 'redirectListUsers')->name('redirectListUsers');
    });
});