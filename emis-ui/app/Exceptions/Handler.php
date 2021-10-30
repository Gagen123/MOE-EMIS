<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
            $message = Response::$statusTexts[$code];

            return response($message, $code);
        }

        if ($exception instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($exception->getModel()));

            return response("Does not exist any instance of {$model} with the given id", Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof AuthorizationException) {
            return response($exception->getMessage(), Response::HTTP_FORBIDDEN);
        }

        if ($exception instanceof AuthenticationException) {
            return response($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof ValidationException) {
            $errors = $exception->validator->errors()->getMessages();
            return response($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($exception instanceof ClientException) {
            $message = $exception->getResponse()->getBody();
            $code = $exception->getCode();

            // dd($message);

            return response($message, $code);
        }

        if (env('APP_DEBUG', true)) {
            // return response($exception->getResponse()->getBody()->getContents(), Response::HTTP_UNPROCESSABLE_ENTITY);
             return parent::render($request, $exception);
        }
        return response('Unexpected error. Try later', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
