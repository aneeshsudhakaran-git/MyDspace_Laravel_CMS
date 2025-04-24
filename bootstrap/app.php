<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\CheckAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => CheckAdmin::class,
 
        ]);

        // session expiration from guard, will navigate to corresponding login
        $middleware->redirectGuestsTo(function () {
            // Check if the request is for the admin area

            //dd(request()->is('admin/*'));
            if (request()->is('admin/*')) {
                // Redirect to admin login route
                return route('admin.login');
            }

            // Default redirection for non-admin routes
            return route('login');
        });


    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
