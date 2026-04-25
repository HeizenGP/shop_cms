<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // --- ESTA ES LA LÍNEA CRÍTICA ---
        // Permite que las peticiones desde React (Vite) sean "Stateful"
        // (Es decir, que Laravel reconozca quién es el usuario a través de la sesión)
        $middleware->statefulApi();

        // Opcional: Si necesitas que tus Slices tengan comportamientos específicos
        // puedes añadir más configuraciones aquí.
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
