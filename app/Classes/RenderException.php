<?php

namespace App\Classes;

use App\Traits\ApiResponses;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use ReflectionObject;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RenderException
{
    use ApiResponses;

    public function __construct(public Exception $exception, public Request $request) {}

    public function render(): JsonResponse
    {
        return match (get_class($this->exception)) {
            NotFoundHttpException::class => $this->handlerNotFound(),
            ValidationException::class => $this->handleValidation(),
            default => $this->handlerStandard(),
        };
    }

    private function handlerStandard(): JsonResponse
    {
        $exceptionReflection = new ReflectionObject($this->exception);

        $error = [
            'type' => $exceptionReflection->getShortName(),
            'message' => $this->exception->getMessage(),
            'code' => $this->exception->getCode(),
        ];

        if (app()->hasDebugModeEnabled()) {
            $error['source'] = 'Line ' . $this->exception->getLine() . ' in ' . $this->exception->getFile();
        }

        return $this->error($error);
    }

    private function handlerNotFound(): JsonResponse
    {
        $error = [
            'message' => 'Resource not found',
            'code' => 404,
        ];

        if (app()->hasDebugModeEnabled()) {
            $error['source'] = $this->exception->getPrevious()?->getModel();
        }

        return $this->error($error);
    }

    private function handleValidation(): JsonResponse
    {
        foreach ($this->exception->errors() as $key => $value) {
            foreach ($value as $message) {
                $error = [
                    'status' => 422,
                    'message' => $message,
                ];

                if (app()->hasDebugModeEnabled()) {
                    $error['source'] = $key;
                }

                $errors[] = $error;
            }
        }

        return $this->error($errors);
    }
}
