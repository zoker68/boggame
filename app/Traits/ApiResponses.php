<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponses
{
    protected function success(?array $data = null, int $code = 200): JsonResponse
    {
        // some logic, if we have
        return response()->json($data ?? [], $code);
    }

    protected function error(string|array $message = 'Error', int $code = 500): JsonResponse
    {
        if (is_string($message)) {
            return response()->json([
                'message' => $message,
            ], $code);
        }

        return response()->json([
            'errors' => $message,
        ], $code);
    }
}
