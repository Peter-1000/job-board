<?php

namespace App\Services\Implementations;

use App\Dto\SaveCityDto;
use App\Repositories\ICityRepository;
use App\Services\ICityServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CityService implements ICityServices
{
    protected ICityRepository $cityRepo;

    public function __construct(ICityRepository $cityRepo)
    {
        $this->cityRepo = $cityRepo;
    }

    public function create(SaveCityDto $dto): Model
    {
        return $this->cityRepo->create($dto->toArray());
    }

    public function update($id, SaveCityDto $dto): Model
    {
        return $this->cityRepo->update($id, $dto->toArray());
    }

    public function delete($id): void
    {
        $this->cityRepo->delete($id);
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->cityRepo->getAll();
    }

    public function find($id): ?Model
    {
        return $this->cityRepo->find($id);
    }
}
