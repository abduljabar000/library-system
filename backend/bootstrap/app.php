<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Encryption\Encrypter;
use Illuminate\Cookie\CookieJar;
use Illuminate\Session\SessionManager;
use Illuminate\Session\Store;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web([
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withBindings([
        'encrypter' => function ($app) {
            $key = $app->make('config')->get('app.key');
            $cipher = $app->make('config')->get('app.cipher');

            if (empty($key)) {
                throw new RuntimeException('No application encryption key has been specified.');
            }

            if (strpos($key, 'base64:') === 0) {
                $key = base64_decode(substr($key, 7));
            }

            return new Encrypter($key, $cipher);
        },
        'cookie' => function () {
            return new CookieJar();
        },
        'session' => function ($app) {
            return new SessionManager($app);
        },
        'session.store' => function ($app) {
            return $app->make('session')->driver();
        }
    ])
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Throwable $e) {
            //
        });
    })->create();
