<?php

declare(strict_types=1);

namespace App\Main\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait DefaultJsonResponseTrait
{
    protected function success(
        array|object $data = [],
        int $code = 200,
        string $message = 'OK'
    ): JsonResponse {
        return response()->json([
            'data' => $data,
            'status' => [
                'code' => $code,
                'message' => $message,
                'success' => true,
            ],
        ]);
    }

    protected function created(array|object $data): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => [
                'code' => Response::HTTP_CREATED,
                'message' => 'CREATED',
                'success' => true,
            ],
        ], Response::HTTP_CREATED);
    }

    protected function fail(array|object $data, int $code, string $message): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => [
                'code' => $code,
                'message' => $message,
                'success' => false,
            ],
        ], $code);
    }

    protected function validateFail(string $message, array $errors): JsonResponse
    {
        return $this->fail(
            [
                'message' => $message,
                'errors' => $errors,
            ],
            Response::HTTP_UNPROCESSABLE_ENTITY,
            'UNPROCESSABLE ENTITY'
        );
    }

    protected function notFound(?string $message = null): JsonResponse
    {
        $message = $message ?? 'Resource not found.';

        return $this->fail(['message' => $message], Response::HTTP_NOT_FOUND, 'NOT FOUND');
    }

    protected function unauthorized(?string $message = null): JsonResponse
    {
        $message = $message ?? 'Unauthenticated.';

        return $this->fail(
            ['message' => $message],
            Response::HTTP_UNAUTHORIZED,
            'UNAUTHORIZED'
        );
    }

    protected function forbidden(?string $message = null): JsonResponse
    {
        $message = $message ?? 'This action is unauthorized.';

        return $this->fail(
            ['message' => $message],
            Response::HTTP_FORBIDDEN,
            'FORBIDDEN'
        );
    }

    protected function internalServerError(string $message): JsonResponse
    {
        return $this->fail(
            ['message' => $message],
            Response::HTTP_INTERNAL_SERVER_ERROR,
            'INTERNAL SERVER ERROR'
        );
    }

    protected function badRequest(string $message): JsonResponse
    {
        return $this->fail(
            ['message' => $message],
            Response::HTTP_BAD_REQUEST,
            'BAD REQUEST'
        );
    }
}
