<?php

namespace App\Repositories\Implementations;

use App\Models\Country;
use App\Repositories\ICountryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CountryRepository implements ICountryRepository
{
    public function create(array $data): Model
    {
        return Country::query()->create($data);
    }

    public function find($id): ?Model
    {
        return Country::query()->findOrFail($id);
    }

    public function update($id, array $data): Model
    {
        $country = $this->find($id);
        $country->update($data);
        return $country;
    }

    public function delete($id): void
    {
        $country = $this->find($id);
        $country->delete();
    }

    public function getAll(): LengthAwarePaginator
    {
        return Country::query()->filter()->paginate();
    }
}
