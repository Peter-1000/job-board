<?php

namespace App\Services;

use App\Dto\SaveStateDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IStateServices
{
    public function create(SaveStateDto $dto): Model;

    public function update($id, SaveStateDto $dto): Model;

    public function delete($id): void;

    public function getAll(): LengthAwarePaginator;

    public function find($id): ?Model;

    public function getByCountry($countryId): Collection;
}
