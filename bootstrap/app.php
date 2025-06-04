<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\LoggedAdmin;
use App\Http\Middleware\LoggedUser;
use App\Http\Middleware\LoggedUserLoginAttempt;
use App\Http\Middleware\OwnerOrAdmin;
use App\Http\Middleware\OwnerOrAdminPublicationOwner;
use App\Http\Middleware\User;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => Admin::class,
            'user' => User::class,
            'loggedUser' => LoggedUser::class,
            'loggedAdmin' => LoggedAdmin::class,
            'loggedUserAttempt' => LoggedUserLoginAttempt::class,
            'OwnerOrAdminPublication' => OwnerOrAdminPublicationOwner::class,
            'OwnerOrAdminPublicationOwner' => OwnerOrAdminPublicationOwner::class,
            'OwnerOrAdmin' => OwnerOrAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
