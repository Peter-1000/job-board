<?php

namespace App\Services\Implementations;

use App\Dto\SaveLanguageDto;
use App\Repositories\Implementations\LanguageRepository;
use App\Services\ILanguageServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class LanguageService implements ILanguageServices
{
    protected LanguageRepository $languageRepo;

    public function __construct(LanguageRepository $languageRepo)
    {
        $this->languageRepo = $languageRepo;
    }

    public function create(SaveLanguageDto $dto): Model
    {
        return $this->languageRepo->create($dto->toArray());
    }

    public function update($id, SaveLanguageDto $dto): Model
    {
        return $this->languageRepo->update($id, $dto->toArray());
    }

    public function delete($id): void
    {
        $this->languageRepo->delete($id);
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->languageRepo->getAll();
    }

    public function find($id): ?Model
    {
        return $this->languageRepo->find($id);
    }
}
