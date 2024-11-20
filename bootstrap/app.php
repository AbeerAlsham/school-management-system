<?php

use App\Http\Middleware\{TransactionMiddleware, CheckOwnerMiddleware, checkPermession};

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Traits\ApiResponder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        using: function () {
            Route::middleware('api')
                ->prefix('api')
                ->namespace('App\Http\Controllers\Api')
                ->group(base_path('routes/api.php'));
        },
        commands: __DIR__ . '/../routes/console.php',

        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'checkPermession' => checkPermession::class,
            "transaction" => TransactionMiddleware::class,
            "checkOwner" => CheckOwnerMiddleware::class
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {


        $exceptions->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'message' => 'the object not found.'
            ], 404);
        });

        // $exceptions->renderable(function (AuthorizationException $e, $request) {
        //     return $this->forbiddenResponse('You are not authorized to apply this action');
        // });

        $exceptions->renderable(function (UnauthorizedException $e, $request) {
            return $this->forbiddenResponse('You are not authorized to apply this action');
        });

        // $exceptions->renderable(function (AccessDeniedHttpException $e, $request) {
        //     return $this->forbiddenResponse('You are not authorized to apply this action');
        // });

        // $exceptions->renderable(function (ValidationException $e, $request) {
        //     return $this->badRequestResponse($e->validator->errors()->toArray());
        // });
    })->create();
