<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICategoryRepository
{
    public function create(array $data): Model;
    public function find($id): ?Model;
    public function update($id, array $data): Model;
    public function delete($id): void;
    public function getAll(): LengthAwarePaginator;
}
