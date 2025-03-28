<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\JobCity;
use App\Models\OurJob;
use Illuminate\Database\Seeder;

class OurJobCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OurJob::all()->each(function ($job) {
            $cityId = City::inRandomOrder()->first()->id;
            JobCity::query()->create([
                'our_job_id' => $job->id,
                'city_id' => $cityId
            ]);
        });
    }
}
