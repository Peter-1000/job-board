<?php

namespace App\Services\Implementations;

use App\Dto\SaveAttributeDto;
use App\Repositories\IAttributeRepository;
use App\Services\IAttributeServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class AttributeService implements IAttributeServices
{
    protected IAttributeRepository $attributeRepo;

    public function __construct(IAttributeRepository $attributeRepo)
    {
        $this->attributeRepo = $attributeRepo;
    }

    public function create(SaveAttributeDto $dto): Model
    {
        return $this->attributeRepo->create($dto->toArray());
    }

    public function update($id, SaveAttributeDto $dto): Model
    {
        return $this->attributeRepo->update($id, $dto->toArray());
    }

    public function delete($id): void
    {
        $this->attributeRepo->delete($id);
    }

    public function getAll(): Collection
    {
        return $this->attributeRepo->getAll();
    }

    public function getByType(string $type): array
    {
        $attributes = $this->attributeRepo->getByType($type);
        return array_map(fn($attribute) => $attribute['value'], $attributes->toArray());
    }

    public function find($id): ?Model
    {
        return $this->attributeRepo->find($id);
    }
}
