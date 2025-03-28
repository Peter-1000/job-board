<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveOurJobRequest;
use App\Services\Implementations\OurJobService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class OurJobsController extends Controller
{
    protected OurJobService $jobService;

    public function __construct(OurJobService $jobService)
    {
        $this->jobService = $jobService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $jobs = $this->jobService->getAll();
        return $this->successResponse($jobs);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            $job = $this->jobService->find($id);
            return $this->successResponse($job);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }

    /**
     * @param SaveOurJobRequest $request
     * @return JsonResponse
     */
    public function store(SaveOurJobRequest $request): JsonResponse
    {
        try {
            $job = $this->jobService->create($request->getDto());
            return $this->successResponse(data: $job, statusCode: Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }

    /**
     * @param int $id
     * @param SaveOurJobRequest $request
     * @return JsonResponse
     */
    public function update(int $id, SaveOurJobRequest $request): JsonResponse
    {
        try {
            $job = $this->jobService->update($id, $request->getDto());
            return $this->successResponse($job);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->jobService->delete($id);
            return $this->successResponse(statusCode: Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }

}
