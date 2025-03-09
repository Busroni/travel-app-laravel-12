<?php

use Throwable;
use Illuminate\Http\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        // Tangani Error 404 (Not Found)
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], Response::HTTP_NOT_FOUND);
        }

        return parent::render($request, $exception);
    }
}
