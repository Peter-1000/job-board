<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCategoryRequest;
use App\Services\Implementations\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CategoriesController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the categories.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = $this->categoryService->getAll();
        return $this->successResponse($categories);
    }

    /**
     * Display the specified category.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $category = $this->categoryService->find($id);
            return $this->successResponse($category);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }

    /**
     * Store a newly created category in storage.
     *
     * @param SaveCategoryRequest $request
     * @return JsonResponse
     */
    public function store(SaveCategoryRequest $request): JsonResponse
    {
        try {
            $category = $this->categoryService->create($request->getDto());
            return $this->successResponse(data: $category, statusCode: Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }

    /**
     * Update the specified category in storage.
     *
     * @param int $id
     * @param SaveCategoryRequest $request
     * @return JsonResponse
     */
    public function update(int $id, SaveCategoryRequest $request): JsonResponse
    {
        try {
            $category = $this->categoryService->update($id, $request->getDto());
            return $this->successResponse($category);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }

    /**
     * Remove the specified category from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->categoryService->delete($id);
            return $this->successResponse(statusCode: Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->errorResponse(message: $exception->getMessage());
        }
    }
}
