<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(\App\Http\Middleware\RedirectWwwAndHttp::class);
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
            'company' => \App\Http\Middleware\IsCompany::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

$app->bind('path.public', function () {
    if (file_exists(base_path('public_html'))) {
        return base_path('public_html');
    }
    return base_path('public');
});

return $app;
