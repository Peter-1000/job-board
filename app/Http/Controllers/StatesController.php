<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveStateRequest;
use App\Services\Implementations\StateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class StatesController extends Controller
{
    protected StateService $stateService;

    public function __construct(StateService $stateService)
    {
        $this->stateService = $stateService;
    }

    /**
     * Get all states.
     */
    public function index(): JsonResponse
    {
        $states = $this->stateService->getAll();
        return $this->successResponse($states);
    }

    /**
     * Get all states for a specific country.
     */
    public function getByCountry(int $countryId): JsonResponse
    {
        $states = $this->stateService->getByCountry($countryId);
        return $this->successResponse($states);
    }

    /**
     * Get a single state.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $state = $this->stateService->find($id);
            return $this->successResponse($state);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Store a new state.
     */
    public function store(SaveStateRequest $request): JsonResponse
    {
        try {
            $state = $this->stateService->create($request->getDto());
            return $this->successResponse(data: $state, statusCode: Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Update a state.
     */
    public function update(int $id, SaveStateRequest $request): JsonResponse
    {
        try {
            $state = $this->stateService->update($id, $request->getDto());
            return $this->successResponse($state);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Delete a state.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->stateService->delete($id);
            return $this->successResponse(statusCode: Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->errorResponse($exception->getMessage());
        }
    }
}
