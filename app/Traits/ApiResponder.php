<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponder
{
    public function successResponse(mixed $data, $message, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        if (!$message) {
            $message = Response::$statusTexts[$statusCode];
        }

        return response()->json
            ([
                'status_code' => $statusCode,
                'message' => $message,
                'data' => $data
            ], $statusCode);
    }

    public function errorResponse($message = '', int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        if (!$message) {
            $message = Response::$statusTexts[$statusCode];
        }

        return response()->json
            ([
                'status_code' => $statusCode,
                'message' => ['errors' => $message],
                'data' => null
            ], $statusCode);
    }

    public function okResponse(mixed $data, $message = ''): JsonResponse
    {
        return $this->successResponse($data, $message);
    }

    public function acceptedResponse($message = ''): JsonResponse
    {
        return $this->successResponse(null, $message, Response::HTTP_ACCEPTED);
    }

    public function createdResponse($data, $message = ''): JsonResponse
    {
        return $this->successResponse($data, $message, Response::HTTP_CREATED);
    }

    public function noContentResponse(): JsonResponse
    {
        return $this->successResponse([], null,Response::HTTP_NO_CONTENT);
    }

    public function badRequestResponse($message = ''): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_BAD_REQUEST);
    }

    public function unauthorizedResponse(string $message = ''): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_UNAUTHORIZED);
    }

    public function forbiddenResponse(string $message = ''): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_FORBIDDEN);
    }

    public function notFoundResponse(string $message = ''): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_NOT_FOUND);
    }

    public function validatedError($message = ''): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_NOT_ACCEPTABLE);
    }

    public function conflictResponse(string $message = ''): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_CONFLICT);
    }

    public function unprocessableResponse(string $message = ''): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
