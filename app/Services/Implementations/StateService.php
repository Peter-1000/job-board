<?php

namespace App\Services\Implementations;

use App\Dto\SaveStateDto;
use App\Repositories\IStateRepository;
use App\Services\IStateServices;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class StateService implements IStateServices
{
    protected IStateRepository $stateRepo;

    public function __construct(IStateRepository $stateRepo)
    {
        $this->stateRepo = $stateRepo;
    }

    public function create(SaveStateDto $dto): Model
    {
        return $this->stateRepo->create($dto->toArray());
    }

    public function update($id, SaveStateDto $dto): Model
    {
        return $this->stateRepo->update($id, $dto->toArray());
    }

    public function delete($id): void
    {
        $this->stateRepo->delete($id);
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->stateRepo->getAll();
    }

    public function find($id): ?Model
    {
        return $this->stateRepo->find($id);
    }

    public function getByCountry($countryId): Collection
    {
        return $this->stateRepo->getByCountry($countryId);
    }
}
