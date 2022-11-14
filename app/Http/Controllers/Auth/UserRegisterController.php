<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Resources\Responses\UserAuthResource;
use App\Processors\Auth\AuthUserProcessor;
use Illuminate\Http\JsonResponse;

class UserRegisterController extends Controller
{
    /**
     * @param UserRegisterRequest $request
     * @param AuthUserProcessor $processor
     * @return JsonResponse
     */
    public function __invoke(
        UserRegisterRequest $request,
        AuthUserProcessor $processor
    ): JsonResponse {
        $response = $processor->processRegister($request->validated());

        return $this->created(new UserAuthResource($response));
    }
}
