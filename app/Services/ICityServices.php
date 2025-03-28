<?php

namespace App\Services;

use App\Dto\SaveCityDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ICityServices
{
    public function create(SaveCityDto $dto): Model;

    public function update($id, SaveCityDto $dto): Model;

    public function delete($id): void;

    public function getAll(): LengthAwarePaginator;

    public function find($id): ?Model;
}
