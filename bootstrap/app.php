<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// use App\Http\Middleware\CheckRole;
use App\Http\Middleware\EnsureTokenIsValid;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->web(append: [
        //     CheckRole::class,
        // ]);

        $middleware->appendToGroup('login-required', [
            EnsureTokenIsValid::class,
            // Second::class,
        ]);
        
        // $middleware->append(EnsureTokenIsValid::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
