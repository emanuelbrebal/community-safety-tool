<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(RedirectController::class)->group(function () {
    Route::middleware(['loggedUserAttempt'])->group(function () {
        Route::get('/login', 'redirectLoginUser')->name('redirectLoginUser');
        Route::get('/login-admin', 'redirectLoginAdmin')->name('redirectLoginAdmin');
        Route::get('/user/register', 'redirectRegister')->name('redirectRegister');
        Route::get('/admin/register', 'redirectAdminRegister')->name('redirectAdminRegister');
    });
});

Route::controller(RegisterController::class)->group(function () {
    Route::post('/register-user', 'createRegister')->name('createRegister');
    Route::post('/admin/register-post', 'createAdminRegister')->name('createAdminRegister');
});

Route::controller(LoginController::class)->group(function () {
    Route::post('/login-post', 'userLogin')->name('userLogin');
    Route::post('/logout', 'logout')->name('logout');

    // admin
    Route::post('/admin/login-post', 'adminLogin')->name('adminLogin');
});

//usuários logados
Route::middleware(['loggedUser'])->group(function () {
    Route::controller(PublicationController::class)->group(function () {
        Route::post('/publication/create-post', 'createPublication')->name('createPublication');
        Route::middleware(['OwnerOrAdmin'])->group(function () {
            Route::post('/update-publication-post/{id}', 'updatePublication')->name('updatePublication');
            Route::post('/deactivate-publication/{id}', 'deactivatePublication')->name('deactivatePublication');
            Route::post('/reactivate-publication/{id}', 'reactivatePublication')->name('reactivatePublication');
        });
    });

    Route::controller(RedirectController::class)->group(function () {
        Route::get('/', 'redirectHome')->name('redirectHome');
        Route::get('/publication/create', 'redirectCreatePublication')->name('redirectCreatePublication');
        Route::middleware(['OwnerOrAdmin'])->group(function () {
            Route::get('/update-publication-post/{id}', 'redirectUpdatePublication')->name('redirectUpdatePublication');
        });
    });
});

Route::middleware(['loggedAdmin', 'admin'])->group(function () {

    Route::controller(RedirectController::class)->group(function () {
        Route::get('/list-users', 'redirectListUsers')->name('redirectListUsers');
        Route::middleware(['OwnerOrAdmin'])->group(function () {
            Route::get('/update-user/{id}', 'redirectUpdateUser')->name('redirectUpdateUser');
            Route::get('/update-user-personal-information/{id}', 'redirectUpdatePersonalInformation')->name('redirectUpdatePersonalInformation');
            Route::get('/update-user-address/{id}', 'redirectUpdateUserAddress')->name('redirectUpdateUserAddress');
            Route::get('/update-user-housing-profile/{id}', 'redirectUpdateUserHousingProfile')->name('redirectUpdateUserHousingProfile');

            Route::get('/update-admin/{id}', 'redirectUpdateAdmin')->name('redirectUpdateAdmin');
        });
    });
    Route::controller(UserController::class)->middleware(['OwnerOrAdmin'])->group(function () {
        Route::post('/ban-user/{id}', 'banUser')->name('banUser');
        Route::post('/unban-user/{id}', 'unbanUser')->name('unbanUser');
        Route::post('/update-user-post/{id}', 'updateUser')->name('updateUser');
        Route::post('/update-user-address-post/{id}', 'updateUserAddress')->name('updateUserAddress');
        Route::post('/update-user-housing-profile-post/{id}', 'updateUserHousingProfileAnswers')->name('updateUserHousingProfileAnswers');
    });
    Route::controller(AdminController::class)->group(function () {
        Route::post('/update-admin-post/{id}', 'updateAdmin')->name('updateAdmin');
        Route::post('/deactivate-admin/{id}', 'deactivateAdmin')->name('deactivateAdmin');
        Route::post('/reactivate-admin/{id}', 'reactivateAdmin')->name('reactivateAdmin');
    });
});
