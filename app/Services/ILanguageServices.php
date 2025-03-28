<?php

namespace App\Services;

use App\Dto\SaveLanguageDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ILanguageServices
{
    public function create(SaveLanguageDto $dto): Model;

    public function update($id, SaveLanguageDto $dto): Model;

    public function delete($id): void;

    public function getAll(): LengthAwarePaginator;

    public function find($id): ?Model;
}
