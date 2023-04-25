<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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

    /**
     * Response the exception handling.
     */
    public function render($request, Throwable $exception)
    {
        // Exception de uri 
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException){
            // Verificando requisição ajax
            if($request->expectsJson())
                return response()->json(['error' => 'Not Found URI'], $exception->getStatusCode()); 
        }
        
        // Exception de verbos http
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException){
            // Verificando requisição ajax
            if($request->expectsJson())
                return response()->json(['error' => 'Method Not Allowed'], $exception->getStatusCode()); 
        }
  
        return parent::render($request, $exception);
    }

} 
