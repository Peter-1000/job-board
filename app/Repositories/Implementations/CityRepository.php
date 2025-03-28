<?php

namespace App\Repositories\Implementations;

use App\Models\City;
use App\Repositories\ICityRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CityRepository implements ICityRepository
{
    public function create(array $data): Model
    {
        $city = City::query()->create($data);
        return $this->find($city->id);
    }

    public function find($id): ?Model
    {
        return City::query()->with(['state:id,name,code'])->findOrFail($id);
    }

    public function update($id, array $data): Model
    {
        $city = $this->find($id);
        $city->update($data);
        return $city;
    }

    public function delete($id): void
    {
        $city = $this->find($id);
        $city->delete();
    }

    public function getAll(): LengthAwarePaginator
    {
        return City::query()->with(['state:id,name,code'])->filter()->paginate();
    }
}
