<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e) use ($exceptions) {
            if (
                !$e instanceof ValidationException
            ) {
                if ($e instanceof HttpException) {
                    return response()->json(
                        [
                            'status_code' => $e->getStatusCode(),
                            'message' => $e->getMessage(),
                            'errors' => [$e->getMessage()],
                        ],
                        $e->getStatusCode(),
                        ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                        JSON_UNESCAPED_UNICODE
                    );
                }
                if ($e instanceof ModelNotFoundException) {
                    return response()->json([
                        'status_code' => 404,
                        'message' => 'Model not found',
                        'errors' => ['Model not found'],
                    ], 404);
                }

                if ($e instanceof AuthorizationException || $e instanceof AuthenticationException) {
                    return response()->json([
                        'status_code' => 401,
                        'message' => 'Unauthorised',
                        'errors' => ['Unauthorised'],
                    ], 401);
                }

                $jsonErrors = [
                    'Server Error'
                ];

                if (config('app.debug')) {
                    $jsonErrors[] = $e->getMessage();
                }

                return response()->json([
                    'status_code' => 500,
                    'message' => 'Error',
                    'errors' => $jsonErrors,
                ], 500);
            }
        });
    })->create();
