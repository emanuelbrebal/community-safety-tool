<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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
    Route::post('/login-post', 'userLogin')->name('userLogin');
    Route::post('/logout', 'logout')->name('logout');
    
    // admin
    Route::get('/admin/login', 'showAdminLogin')->name('showAdminLogin');
    Route::post('/admin/login-post', 'adminLogin')->name('adminLogin');
});

//usuários logados
Route::middleware(['loggedUser'])->group(function () { 
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
        Route::get('/update-user/{id}', 'redirectUpdateUser')->name('redirectUpdateUser');
        Route::get('/update-user-personal-information/{id}', 'redirectUpdatePersonalInformation')->name('redirectUpdatePersonalInformation');
        Route::get('/update-user-address/{id}', 'redirectUpdateUserAddress')->name('redirectUpdateUserAddress');
        Route::get('/update-user-housing-profile/{id}', 'redirectUpdateUserHousingProfile')->name('redirectUpdateUserHousingProfile');
    });
    Route::controller(UserController::class)->group(function (){
        Route::post('/ban-user/{id}', 'banUser')->name('banUser');
        Route::post('/unban-user/{id}', 'unbanUser')->name('unbanUser');
        Route::post('/update-user-post/{id}', 'updateUser')->name('updateUser');
        Route::post('/update-user-address-post/{id}', 'updateUserAddress')->name('updateUserAddress');
        Route::post('/update-user-housing-profile-post/{id}', 'updateUserHousingProfileAnswers')->name('updateUserHousingProfileAnswers');
    });
});