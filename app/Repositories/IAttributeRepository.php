<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IAttributeRepository
{
    public function create(array $data): Model;

    public function find($id): ?Model;

    public function update($id, array $data): Model;

    public function delete($id): void;

    public function getAll(): Collection;

    public function getByType(string $type): Collection;

}
