<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // validation exception - will return list of error
        if ($exception instanceof ValidationException) {
            return response()->json([
                'errors' => $exception->validator->errors(),
            ], 422); 
        }

        // default error hanlding
        return response()->json([
            'message' => $exception->getMessage()
            ],Response::HTTP_INTERNAL_SERVER_ERROR 
        );

    }
}
