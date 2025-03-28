<?php

namespace App\Repositories\Implementations;

use App\Models\Category;
use App\Repositories\ICategoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository implements ICategoryRepository
{
    public function create(array $data): Model
    {
        return Category::query()->create($data);
    }

    public function find($id): ?Model
    {
        return Category::query()->findOrFail($id);
    }

    public function update($id, array $data): Model
    {
        $category = $this->find($id);
        $category->update($data);
        return $category;
    }

    public function delete($id): void
    {
        $category = $this->find($id);
        $category->delete();
    }

    public function getAll(): LengthAwarePaginator
    {
        return Category::query()->filter()->paginate();
    }
}
