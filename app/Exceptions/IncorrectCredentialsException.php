<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class IncorrectCredentialsException extends Exception
{
    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json('Provided credentials are incorrect', JsonResponse::HTTP_BAD_REQUEST);
    }
}
