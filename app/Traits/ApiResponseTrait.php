<?php

namespace App\Traits;

use stdClass;

trait ApiResponseTrait
{
    protected function successResponse(string $message = '', int $statusCode = 200)
    {
        $responseStructure = [
            'success' => true,
            'message' => $message,
            'result' => new stdClass(),
        ];

        return response()->json($responseStructure, $statusCode);
    }

    protected function successResponseWithData(string $message = '', array $data = [], int $statusCode = 200)
    {
        $responseStructure = [
            'success' => true,
            'message' => $message,
            'result' => $data,
        ];

        return response()->json($responseStructure, $statusCode);
    }

    protected function successResponseWithHeader(string $message = '', array $data = [], int $statusCode = 200, array $headers = [])
    {
        $responseStructure = [
            'success' => true,
            'message' => $message,
            'result' => (object) $data,
        ];

        return response()->json($responseStructure, $statusCode, $headers);
    }

    protected function errorResponse(string $message = '', int $statusCode = 200)
    {
        $responseStructure = [
            'success' => false,
            'message' => $message,
            'result' => new stdClass,
        ];

        return response()->json($responseStructure, $statusCode);
    }

    protected function errorResponseWithData(string $message = '', int $statusCode = 200, array $data = [])
    {
        $responseStructure = [
            'success' => false,
            'message' => $message,
            'result' => (object) $data,
        ];

        return response()->json($responseStructure, $statusCode);
    }
}
