<?php

namespace App\Services\Implementations;

use App\Dto\SaveCountryDto;
use App\Repositories\ICountryRepository;
use App\Services\ICountryServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CountryService implements ICountryServices
{
    protected ICountryRepository $countryRepo;

    public function __construct(ICountryRepository $countryRepo)
    {
        $this->countryRepo = $countryRepo;
    }

    public function create(SaveCountryDto $dto): Model
    {
        return $this->countryRepo->create($dto->toArray());
    }

    public function update($id, SaveCountryDto $dto): Model
    {
        return $this->countryRepo->update($id, $dto->toArray());
    }

    public function delete($id): void
    {
        $this->countryRepo->delete($id);
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->countryRepo->getAll();
    }

    public function find($id): ?Model
    {
        return $this->countryRepo->find($id);
    }
}
