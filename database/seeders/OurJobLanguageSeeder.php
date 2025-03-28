<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\OurJob;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OurJobLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OurJob::all()->each(function ($job) {
            $languages = Language::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            $job->languages()->attach($languages);
        });
    }
}
