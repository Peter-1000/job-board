<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\OurJob;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OurJobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OurJob::all()->each(function ($job) {
            $categories = Category::inRandomOrder()->limit(rand(1, 2))->pluck('id');
            $job->categories()->attach($categories);
        });
    }
}
