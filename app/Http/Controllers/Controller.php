<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use OpenApi\Attributes\SecurityScheme;

/**
 * @OA\Info(
 *    title="Calculation API",
 *    version="1.0.0",
 * )
 */
#[
    SecurityScheme(
        securityScheme: 'bearer',
        type: 'http',
        name: 'bearer',
        in: 'header',
        scheme: 'bearer'
    )
]
abstract class Controller extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests;

    public function responseSuccess(
        $data = [
            'result' => 'ok',
        ],
        array $attributes = []
    ): JsonResponse {
        return response()->json([
                'status_code' => 200,
                'data' => $data,
            ] + $attributes);
    }

    public function responseError(
        array $errors,
        int $statusCode
    ): JsonResponse {
        return response()->json([
            'status_code' => $statusCode,
            'errors' => $errors,
            'message' => $errors[0],
        ], $statusCode);
    }

    public function responseWithPagination($data, LengthAwarePaginator $pagination): JsonResponse
    {
        return $this->responseSuccess($data, [
            'page' => $pagination->currentPage(),
            'per_page' => $pagination->perPage(),
            'total' => $pagination->total(),
            'last_page' => $pagination->lastPage(),
        ]);
    }

    public function responseNoContent(): JsonResponse
    {
        return response()->json([
            'status_code' => 204,
        ], 204);
    }
}
