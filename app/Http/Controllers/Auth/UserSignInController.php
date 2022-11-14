<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Resources\Responses\UserAuthResource;
use App\Processors\Auth\AuthUserProcessor;
use Illuminate\Http\JsonResponse;
use Throwable;

class UserSignInController extends Controller
{
    /**
     * @param UserLoginRequest $request
     * @param AuthUserProcessor $processor
     * @return JsonResponse
     * @throws Throwable
     */
    public function __invoke(
        UserLoginRequest $request,
        AuthUserProcessor $processor
    ): JsonResponse {
        $response = $processor->processSignIn($request->validated());

        return $this->ok(new UserAuthResource($response));
    }
}
