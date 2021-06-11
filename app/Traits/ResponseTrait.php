<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function success(array $data = null): JsonResponse
    {
        return response()->json($data, 200);
    }

    public function unauthorized(array $data = null): JsonResponse
    {
        return response()->json($data, 401);
    }

    public function error(array $data = null): JsonResponse
    {
        return response()->json($data, 422);
    }
}
