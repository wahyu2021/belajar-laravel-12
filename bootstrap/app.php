<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'input/*',
            'file/*'
            // Anda bisa menambahkan lebih banyak rute di sini
        ]);
        $middleware->encryptCookies(except: [
            'input/*',
            'file/*'
            // Anda bisa menambahkan lebih banyak rute di sini
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
