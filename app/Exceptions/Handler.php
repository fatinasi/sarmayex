<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (ValidationException $e, $request) {
            if ($request->expectsJson()) {
               return response('Sorry, validation failed.', 422);
            }
        });
        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->expectsJson()) {
               return response('Sorry, authentication failed.', 401);
            }
        });
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
               return response('Sorry,  route not found.', 404);
            }
        });
    }
}
