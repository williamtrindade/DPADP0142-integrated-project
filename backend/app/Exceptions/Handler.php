<?php

namespace App\Exceptions;

use Exception;
use HttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
     * Report or log an exception.
     *
     * @param Throwable $exception
     * @return void
     *
     * @throws Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response
    {
        if ($e instanceof ThrottleRequestsException) {
            return new JsonResponse([
                'success' => false,
                'message' => JsonResponse::$statusTexts[Response::HTTP_TOO_MANY_REQUESTS]
            ], Response::HTTP_TOO_MANY_REQUESTS);
        }

        if ($e instanceof AuthenticationException) {
            return new JsonResponse([
                'success' => false,
                'message' => JsonResponse::$statusTexts[Response::HTTP_UNAUTHORIZED]
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof ModelNotFoundException) {
            return new JsonResponse([
                'success' => false,
                'message' => JsonResponse::$statusTexts[Response::HTTP_NOT_FOUND]
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof ModelNotFoundException) {
            return new JsonResponse([
                'success' => false,
                'message' => JsonResponse::$statusTexts[Response::HTTP_NOT_FOUND]
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof NotFoundHttpException) {
            return new JsonResponse([
                'success' => false,
                'message' => JsonResponse::$statusTexts[Response::HTTP_NOT_FOUND]
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof UnauthorizedException) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof ForbiddenException) {
            return new JsonResponse([
                'success' => false,
                'message' => JsonResponse::$statusTexts[Response::HTTP_FORBIDDEN]
            ], Response::HTTP_FORBIDDEN);
        }

        if ($e instanceof ValidationException) {
            /** @var ValidationException $e */
            return new JsonResponse([
                'success' => false,
                'message' => JsonResponse::$statusTexts[Response::HTTP_UNPROCESSABLE_ENTITY],
                'data' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($e instanceof BadRequestHttpException) {
            return new JsonResponse([
                'success' => false,
                'message' => JsonResponse::$statusTexts[Response::HTTP_BAD_REQUEST],
                'data' => [
                    'error' => $e->getMessage()
                ]
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($e instanceof HttpException) {
            return new JsonResponse([
                'success' => false,
                'message' => $e->getMessage() ? $e->getMessage() : JsonResponse::$statusTexts[$e->getStatusCode()]
            ], $e->getStatusCode());
        }
        return parent::render($request, $e);
    }
}
