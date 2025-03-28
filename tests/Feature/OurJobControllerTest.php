<?php

namespace Tests\Feature;

use App\Models\Language;
use App\Models\OurJob;
use App\Models\Category;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OurJobControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_it_can_list_jobs()
    {
        OurJob::factory()->count(3)->create();

        $response = $this->getJson(route('our-jobs.index'));

        $response->assertOk();
    }

    public function test_it_can_show_a_single_job()
    {
        $job = OurJob::factory()->create();

        $response = $this->getJson(route('our-jobs.show', $job->id));

        $response->assertOk()
            ->assertJson(['data' => ['id' => $job->id]]);
    }

    public function test_it_can_create_a_job()
    {
        $languages = Language::factory()->count(2)->create();
        $categories = Category::factory()->count(2)->create();
        $cities = City::factory()->count(2)->create();

        $data = [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->text(100),
            'company_name' => $this->faker->company,
            'salary' => 30000,
            'is_remote' => true,
            'job_type' => 'full-time',
            'status' => 'archived',
            'published_at' => now()->toDateTimeString(),
            'languages' => $languages->pluck('id')->toArray(),
            'categories' => $categories->pluck('id')->toArray(),
            'cities' => $cities->pluck('id')->toArray(),
        ];

        $response = $this->postJson(route('our-jobs.store'), $data);

        $response->assertCreated();

        $this->assertDatabaseHas('our_jobs', ['title' => $data['title']]);
    }

    public function test_it_can_update_a_job()
    {
        $job = OurJob::factory()->create();

        $languages = Language::factory()->count(2)->create();
        $categories = Category::factory()->count(2)->create();
        $cities = City::factory()->count(2)->create();

        $updateData = [
            'title' => 'Updated Job Title',
            'description' => $this->faker->text(100),
            'company_name' => $this->faker->company,
            'salary' => 30000,
            'is_remote' => true,
            'job_type' => 'full-time',
            'status' => 'archived',
            'published_at' => now()->toDateTimeString(),
            'languages' => $languages->pluck('id')->toArray(),
            'categories' => $categories->pluck('id')->toArray(),
            'cities' => $cities->pluck('id')->toArray(),
        ];
        $response = $this->putJson(route('our-jobs.update', $job->id), $updateData);

        $response->assertOk();

        $this->assertDatabaseHas('our_jobs', ['id' => $job->id, 'title' => $updateData['title']]);
    }

    public function test_it_can_delete_a_job()
    {
        $job = OurJob::factory()->create();

        $response = $this->deleteJson(route('our-jobs.destroy', $job->id));

        $response->assertNoContent();

        $this->assertDatabaseMissing('our_jobs', ['id' => $job->id]);
    }
}
