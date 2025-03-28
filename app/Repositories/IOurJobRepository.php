<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IOurJobRepository
{
    public function create(array $mainData, array $relationsData): ?Model;

    public function update(int $id, array $mainData, array $relationsData): ?Model;

    public function find(int $id): ?Model;

    public function delete(int $id): void;

    public function getAll(): LengthAwarePaginator;

    public function getSalaryRange(): array;
}
