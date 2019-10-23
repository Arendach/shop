<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

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

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        if ($request->ajax() || $request->wantsJson()) {
            if ($exception instanceof ValidationException) {
                $format_errors = [];

                foreach ($exception->errors() as $k => $error) {
                    $format_errors[$k] = implode('<br>', $error);
                }

                $json = [
                    'success' => false,
                    'message' => __('common.data_not_valid'),
                    'errors' => $format_errors,
                ];

                return response()->json($json, 400);
            }
        }

        return parent::render($request, $exception);
    }
}
