<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * @param $data
     * @return JsonResponse
     */
    public function ok($data): JsonResponse
    {
        return response()->json($data);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function created($data): JsonResponse
    {
        return response()->json($data, JsonResponse::HTTP_CREATED);
    }
}
