<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Resources\Responses\UserAuthResource;
use App\Processors\Auth\AuthUserProcessor;
use Illuminate\Http\JsonResponse;

class ResetPasswordController extends Controller
{
    /**
     * @param ResetPasswordRequest $request
     * @param AuthUserProcessor $processor
     * @return JsonResponse
     */
    public function __invoke(
        ResetPasswordRequest $request,
        AuthUserProcessor $processor
    ): JsonResponse {
        $response = $processor->processPasswordReset($request->validated());

        return $this->ok(new UserAuthResource($response));
    }
}
