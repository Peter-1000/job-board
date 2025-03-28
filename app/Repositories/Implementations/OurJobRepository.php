<?php

namespace App\Repositories\Implementations;

use App\Models\JobCategory;
use App\Models\JobLanguage;
use App\Models\JobCity;
use App\Models\OurJob;
use App\Repositories\IOurJobRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OurJobRepository implements IOurJobRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return OurJob::query()->with(['languages:id,name', 'categories:id,name', 'cities:id,name'])->filter()->paginate();
    }

    private function _addRelations($data, $job): void
    {
        // Sync languages
        $job->languages()->sync($data['languages']);

        // Sync categories
        $job->categories()->sync($data['categories']); // This will sync the categories.

        // Sync cities
        $job->cities()->sync($data['cities']);
    }

    private function _addAttributes($data, $jobId): void
    {
        $attributeRepository = new AttributeRepository();
        $attributeRepository->create([
            'our_job_id' => $jobId,
            'value' => $data['job_type'],
            'type' => $data['job_type'],
        ]);
        $attributeRepository->create([
            'our_job_id' => $jobId,
            'value' => $data['status'],
            'type' => $data['status'],
        ]);
    }

    /**
     * @param array $mainData
     * @param array $relationsData
     * @return ?Model
     */
    public function create(array $mainData, array $relationsData): ?Model
    {
        try {
            DB::beginTransaction();
            $job = OurJob::query()->create($mainData);
            $this->_addRelations($relationsData, $job);
            $this->_addAttributes($mainData, $job->id);
            DB::commit();
            return $this->find($job->id);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        return OurJob::query()->with(['languages:id,name', 'categories:id,name', 'cities:id,name'])->findOrFail($id);
    }

    private function _removeRelationsAndAttributes($job): void
    {
        try {
            DB::beginTransaction();
            $job->languages()->detach();
            $job->categories()->detach();
            $job->citites()->detach();
            $job->attributes()->detach();
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
        }
    }

    /**
     * @param int $id
     * @param array $mainData
     * @param array $relationsData
     * @return ?Model
     */
    public function update(int $id, array $mainData, array $relationsData): ?Model
    {
        try {
            DB::beginTransaction();
            $job = $this->find($id);
            $this->_removeRelationsAndAttributes($job);
            $this->_addRelations($relationsData, $job);
            $this->_addAttributes($mainData, $job->id);
            $job->update($mainData);
            DB::commit();
            return $job;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function delete($id): void
    {
        $job = $this->find($id);
        $job->delete();
    }

    public function getSalaryRange(): array
    {
        return [
            'min' => (float)OurJob::query()->min('salary'),
            'max' => (float)OurJob::query()->max('salary'),
        ];
    }
}
