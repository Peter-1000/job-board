<?php

namespace App\Repositories\Implementations;

use App\Models\Language;
use App\Repositories\ILanguageRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class LanguageRepository implements ILanguageRepository
{
    public function create(array $data): Model
    {
        return Language::query()->create($data);
    }

    public function find($id): ?Model
    {
        return Language::query()->findOrFail($id);
    }

    public function update($id, array $data): Model
    {
        $language = $this->find($id);
        $language->update($data);
        return $language;
    }

    public function delete($id): void
    {
        $language = $this->find($id);
        $language->delete();
    }

    public function getAll(): LengthAwarePaginator
    {
        return Language::query()->filter()->paginate();
    }
}
