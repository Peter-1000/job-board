<?php

namespace App\Services\Implementations;

use App\Dto\SaveOurJobDto;
use App\Repositories\IOurJobRepository;
use App\Services\IOurJobServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class OurJobService implements IOurJobServices
{
    protected IOurJobRepository $jobRepo;

    public function __construct(IOurJobRepository $jobRepo)
    {
        $this->jobRepo = $jobRepo;
    }

    public function create(SaveOurJobDto $dto): ?Model
    {
        return $this->jobRepo->create($dto->toArray(), $dto->relations());
    }

    public function update($id, SaveOurJobDto $dto): Model
    {
        return $this->jobRepo->update($id, $dto->toArray(), $dto->relations());
    }

    public function delete($id): void
    {
        $this->jobRepo->delete($id);
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->jobRepo->getAll();
    }

    public function find($id): ?Model
    {
        return $this->jobRepo->find($id);
    }

    public function getSalaryRange(): array
    {
        return $this->jobRepo->getSalaryRange();
    }
}
