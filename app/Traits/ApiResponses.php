<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponses
{
    protected function success(string $message = 'Success', ?array $data = null): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response);
    }

    protected function error(string|array $message = 'Error'): JsonResponse
    {
        if (is_string($message)) {
            return response()->json([
                'success' => false,
                'message' => $message,
            ]);
        }

        return response()->json([
            'success' => false,
            'errors' => $message,
        ]);
    }
}
