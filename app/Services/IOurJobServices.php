<?php

namespace App\Services;

use App\Dto\SaveOurJobDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IOurJobServices
{
    public function create(SaveOurJobDto $dto): ?Model;

    public function update($id, SaveOurJobDto $dto): ?Model;

    public function delete($id): void;

    public function getAll(): LengthAwarePaginator;

    public function find($id): ?Model;

    public function getSalaryRange(): array;
}
