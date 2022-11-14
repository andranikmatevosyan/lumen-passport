<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Processors\Company\CompanyProcessor;
use Illuminate\Http\JsonResponse;

class CompanyListController extends Controller
{
    /**
     * @param CompanyProcessor $processor
     * @return JsonResponse
     */
    public function __invoke(
        CompanyProcessor $processor
    ): JsonResponse {
        $response = $processor->processList($this->user());

        return $this->ok(CompanyResource::collection($response));
    }
}
