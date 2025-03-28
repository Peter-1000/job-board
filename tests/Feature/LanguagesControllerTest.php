<?php

namespace Tests\Feature;

use App\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LanguagesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_languages()
    {
        Language::factory()->count(5)->create();

        $response = $this->getJson(route('languages.index'));

        $response->assertOk();
    }

    public function test_it_can_retrieve_a_single_language()
    {
        $language = Language::factory()->create();

        $response = $this->getJson(route('languages.show', $language->id));

        $response->assertOk();
    }

    public function test_it_can_create_a_language()
    {
        $data = ['name' => 'PHP'];

        $response = $this->postJson(route('languages.store'), $data);

        $response->assertCreated();

        $this->assertDatabaseHas('languages', $data);
    }

    public function test_it_can_update_a_language()
    {
        $language = Language::factory()->create();
        $updatedData = ['name' => 'Javascript'];

        $response = $this->putJson(route('languages.update', $language->id), $updatedData);

        $response->assertOk();

        $this->assertDatabaseHas('languages', $updatedData);
    }

    public function test_it_can_delete_a_language()
    {
        $language = Language::factory()->create();

        $response = $this->deleteJson(route('languages.destroy', $language->id));

        $response->assertNoContent();
        $this->assertDatabaseMissing('languages', ['id' => $language->id]);
    }
}
