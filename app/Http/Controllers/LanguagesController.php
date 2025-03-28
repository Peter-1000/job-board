<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveLanguageRequest;
use App\Services\Implementations\LanguageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LanguagesController extends Controller
{
    protected LanguageService $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    /**
     * Display a listing of the languages.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $languages = $this->languageService->getAll();
        return $this->successResponse($languages);
    }

    /**
     * Display the specified language.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $language = $this->languageService->find($id);
            return $this->successResponse($language);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }

    /**
     * Store a newly created language in storage.
     *
     * @param SaveLanguageRequest $request
     * @return JsonResponse
     */
    public function store(SaveLanguageRequest $request): JsonResponse
    {
        try {
            $language = $this->languageService->create($request->getDto());
            return $this->successResponse(data: $language, statusCode: Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }

    /**
     * Update the specified language in storage.
     *
     * @param int $id
     * @param SaveLanguageRequest $request
     * @return JsonResponse
     */
    public function update(int $id, SaveLanguageRequest $request): JsonResponse
    {
        try {
            $language = $this->languageService->update($id, $request->getDto());
            return $this->successResponse($language);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }

    /**
     * Remove the specified language from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->languageService->delete($id);
            return $this->successResponse(statusCode: Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }
}
