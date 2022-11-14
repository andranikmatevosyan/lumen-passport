<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyCreateRequest;
use App\Http\Resources\CompanyResource;
use App\Processors\Company\CompanyProcessor;
use Illuminate\Http\JsonResponse;

class CompanyCreateController extends Controller
{
    /**
     * @param CompanyCreateRequest $request
     * @param CompanyProcessor $processor
     * @return JsonResponse
     */
    public function __invoke(
        CompanyCreateRequest $request,
        CompanyProcessor $processor
    ): JsonResponse {
        $response = $processor->processCreate($this->user(), $request->validated());

        return $this->created(new CompanyResource($response));
    }
}
