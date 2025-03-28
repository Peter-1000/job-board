<?php

namespace App\Services;

use App\Dto\SaveCountryDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICountryServices
{
    public function create(SaveCountryDto $dto): Model;

    public function update($id, SaveCountryDto $dto): Model;

    public function delete($id): void;

    public function getAll(): LengthAwarePaginator;

    public function find($id): ?Model;
}
