<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCountryRequest;
use App\Services\Implementations\CountryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CountriesController extends Controller
{
    protected CountryService $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    /**
     * Get all countries.
     */
    public function index(): JsonResponse
    {
        $countries = $this->countryService->getAll();
        return $this->successResponse($countries);
    }

    /**
     * Get a single country.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $country = $this->countryService->find($id);
            return $this->successResponse($country);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Store a new country.
     */
    public function store(SaveCountryRequest $request): JsonResponse
    {
        try {
            $country = $this->countryService->create($request->getDto());
            return $this->successResponse(data: $country, statusCode: Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Update a country.
     */
    public function update(int $id, SaveCountryRequest $request): JsonResponse
    {
        try {
            $country = $this->countryService->update($id, $request->getDto());
            return $this->successResponse($country);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Delete a country.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->countryService->delete($id);
            return $this->successResponse(statusCode: Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->errorResponse($exception->getMessage());
        }
    }
}

