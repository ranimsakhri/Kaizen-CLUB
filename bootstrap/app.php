<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    // ================= MIDDLEWARES =================
    ->withMiddleware(function (Middleware $middleware): void {

        // Alias des middlewares
        $middleware->alias([
            'is_admin' => \App\Http\Middleware\IsAdmin::class,
        ]);

    })

    // ================= EXCEPTIONS =================
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();
