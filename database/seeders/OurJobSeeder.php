<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\OurJob;
use Illuminate\Database\Seeder;

class OurJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $jobs = OurJob::factory()->count(100)->create();
       foreach ($jobs as $job) {
           Attribute::query()->updateOrCreate([
              'our_job_id' => $job->id,
              'value' => $job->job_type,
              'type' => 'job_type',
           ]);
           Attribute::query()->updateOrCreate([
              'our_job_id' => $job->id,
              'value' => $job->status,
              'type' => 'status',
           ]);
       }
    }
}
