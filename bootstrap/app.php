<?php

use App\Exceptions\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Application;
use App\Http\Middleware\ContohMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->validateCsrfTokens(except: [
        //     'input/*',
        //     'file/*'
        //     // Anda bisa menambahkan lebih banyak rute di sini
        // ]);
        $middleware->encryptCookies(except: [
            'input/*',
            'file/*'
            // Anda bisa menambahkan lebih banyak rute di sini
        ]);
        $middleware->alias([
            'contoh' => ContohMiddleware::class,
        ]);

        // Menambahkan m  iddleware ke grup pzn
        $middleware->group('pzn', [
            'contoh:PZN,401',
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->reportable(function (Throwable $error){
            var_dump($error->getMessage());
            return false;
        });

        $exceptions->dontReport([
            ValidationException::class
        ]);
        $exceptions->renderable(function(ValidationException $exceptions, Request $request){
            return response("Bad Request", 401);
        });
    })->create();
