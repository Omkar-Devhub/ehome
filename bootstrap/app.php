<?php

use App\Http\Middleware\User;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Agent;
use Illuminate\Foundation\Application;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\Vendor;
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
            'auth' => User::class,
            'admin' => Admin::class,
            'vendor' => Vendor::class,
            'agent' => Agent::class,
            'redirect' => RedirectIfAuthenticated::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
