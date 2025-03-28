<?php

namespace App\Services\Implementations;

use App\Dto\SaveCategoryDto;
use App\Repositories\ICategoryRepository;
use App\Services\ICategoryServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService implements ICategoryServices
{
    protected ICategoryRepository $categoryRepo;

    public function __construct(ICategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function create(SaveCategoryDto $dto): Model
    {
        return $this->categoryRepo->create($dto->toArray());
    }

    public function update($id, SaveCategoryDto $dto): Model
    {
        return $this->categoryRepo->update($id, $dto->toArray());
    }

    public function delete($id): void
    {
        $this->categoryRepo->delete($id);
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->categoryRepo->getAll();
    }

    public function find($id): ?Model
    {
        return $this->categoryRepo->find($id);
    }
}
