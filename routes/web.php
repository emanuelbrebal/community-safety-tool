<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

Route::controller(RedirectController::class)->group(function (){
    Route::get('/', 'redirectHome')->name('redirectHome');
    Route::get('/listUsers', 'redirectListUsers')->name('redirectListUsers');
});


Route::controller(LoginController::class)->group(function (){
    Route::get('/registro', 'redirectRegister')->name('redirectRegister');
    Route::post('/criarRegistro', 'createRegister')->name('createRegister');
    // Route::put('/registro', 'redirectRegister')->name('redirectRegister');
    // Route::delete('/registro', 'redirectRegister')->name('redirectRegister');
});