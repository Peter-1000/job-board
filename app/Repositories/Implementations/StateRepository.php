<?php

namespace App\Repositories\Implementations;

use App\Models\State;
use App\Repositories\IStateRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class StateRepository implements IStateRepository
{
    public function create(array $data): Model
    {
        return State::query()->create($data);
    }

    public function find($id): ?Model
    {
        return State::query()->with(['country:id,name,code'])->findOrFail($id);
    }

    public function update($id, array $data): Model
    {
        $state = $this->find($id);
        $state->update($data);
        return $state;
    }

    public function delete($id): void
    {
        $state = $this->find($id);
        $state->delete();
    }

    public function getAll(): LengthAwarePaginator
    {
        return State::query()->with(['country:id,name,code'])->filter()->paginate();
    }

    public function getByCountry($countryId): Collection
    {
        return State::query()->where('country_id', $countryId)->get();
    }
}
