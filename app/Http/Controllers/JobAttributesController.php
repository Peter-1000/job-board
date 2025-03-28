<?php

namespace App\Http\Controllers;

use App\Services\Implementations\AttributeService;
use App\Services\Implementations\OurJobService;
use Illuminate\Http\JsonResponse;


class JobAttributesController extends Controller
{

    private AttributeService $attributeService;
    private OurJobService $ourJobService;

    public function __construct(AttributeService $attributeService, OurJobService $ourJobService)
    {
        $this->attributeService = $attributeService;
        $this->ourJobService = $ourJobService;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return $this->successResponse(data: [
            'job_types' => $this->attributeService->getByType('job_type'),
            'job_status' => $this->attributeService->getByType('status'),
            'salary_range' => $this->ourJobService->getSalaryRange(),
            'is_remote' => [
                'false' => 0,
                'true' => 1,
            ],
        ]);
    }

}
