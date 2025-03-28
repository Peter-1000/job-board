<?php

namespace App\Repositories\Implementations;

use App\Models\Attribute;
use App\Repositories\IAttributeRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AttributeRepository implements IAttributeRepository
{
    public function create(array $data): Model
    {
        return Attribute::query()->create($data);
    }

    public function find($id): ?Model
    {
        return Attribute::query()->findOrFail($id);
    }

    public function update($id, array $data): Model
    {
        $attribute = $this->find($id);
        $attribute->update($data);
        return $attribute;
    }

    public function delete($id): void
    {
        $attribute = $this->find($id);
        $attribute->delete();
    }

    public function getAll(): Collection
    {
        return Attribute::query()->get();
    }

    public function getByType(string $type): Collection
    {
        return Attribute::query()
            ->select('value')
            ->where('type', $type)
            ->groupBy('type')
            ->groupBy('value')
            ->get();
    }
}
