<?php

namespace App\Services;

use App\Dto\SaveAttributeDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface IAttributeServices
{
    public function create(SaveAttributeDto $dto): Model;

    public function update($id, SaveAttributeDto $dto): Model;

    public function delete($id): void;

    public function getAll(): Collection;

    public function getByType(string $type): array;

    public function find($id): ?Model;
}
