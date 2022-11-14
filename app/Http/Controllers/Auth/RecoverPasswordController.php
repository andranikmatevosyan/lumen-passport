<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RecoverPasswordRequest;
use App\Http\Resources\Responses\MessageResource;
use App\Processors\Auth\AuthUserProcessor;
use Illuminate\Http\JsonResponse;

class RecoverPasswordController extends Controller
{
    /**
     * @param RecoverPasswordRequest $request
     * @param AuthUserProcessor $processor
     * @return JsonResponse
     */
    public function __invoke(
        RecoverPasswordRequest $request,
        AuthUserProcessor $processor
    ): JsonResponse {
        $processor->processRecoverPassword($request->validated());

        return $this->ok(new MessageResource(['message' => 'Password recover email was sent to your email address']));
    }
}
