<?php

namespace Database\Factories;

use App\Models\OurJob;
use App\Enums\JobTypeEnum;
use App\Enums\JobStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class OurJobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OurJob::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->paragraph,
            'company_name' => $this->faker->title,
            'salary' => $this->faker->numberBetween(1000, 10000),
            'is_remote' => $this->faker->boolean(),
            'job_type' => $this->faker->randomElement(['full-time', 'part-time', 'contract', 'freelance']),
            'status' =>  $this->faker->randomElement([ 'draft', 'published', 'archived']),
            'published_at' => now(),
        ];
    }
}
