<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCityRequest;
use App\Services\Implementations\CityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CitiesController extends Controller
{
    protected CityService $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    /**
     * Display a listing of the cities.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $cities = $this->cityService->getAll();
        return $this->successResponse($cities);
    }

    /**
     * Display the specified city.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $city = $this->cityService->find($id);
            return $this->successResponse($city);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }

    /**
     * Store a newly created city in storage.
     *
     * @param SaveCityRequest $request
     * @return JsonResponse
     */
    public function store(SaveCityRequest $request): JsonResponse
    {
        try {
            $city = $this->cityService->create($request->getDto());
            return $this->successResponse(data: $city, statusCode: Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }

    /**
     * Update the specified city in storage.
     *
     * @param int $id
     * @param SaveCityRequest $request
     * @return JsonResponse
     */
    public function update(int $id, SaveCityRequest $request): JsonResponse
    {
        try {
            $city = $this->cityService->update($id, $request->getDto());
            return $this->successResponse($city);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }

    /**
     * Remove the specified city from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->cityService->delete($id);
            return $this->successResponse(statusCode: Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }
}
