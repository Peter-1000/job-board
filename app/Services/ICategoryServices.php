<?php

namespace App\Services;

use App\Dto\SaveCategoryDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICategoryServices
{
    public function create(SaveCategoryDto $dto): Model;

    public function update($id, SaveCategoryDto $dto): Model;

    public function delete($id): void;

    public function getAll(): LengthAwarePaginator;

    public function find($id): ?Model;
}
