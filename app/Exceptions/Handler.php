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

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $model = $exception->getModel();

            if (method_exists($model, 'getReadableClassName')) {
                $readableModelName = $model::getReadableClassName();
            } else {
                $readableModelName = Str::title(str_replace('_', ' ', Str::snake(class_basename($model))));
            }

            abort(404, __('Data :model tidak ditemukan', ['model' => $readableModelName]));
        } else if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            return response()->json(['message' => __('Sesi login telah berakhir.')], 401);
        }

        return parent::render($request, $exception);
    }
}
