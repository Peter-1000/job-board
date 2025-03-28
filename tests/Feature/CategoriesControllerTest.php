<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_categories()
    {
        Category::factory()->count(5)->create();

        $response = $this->getJson(route('categories.index'));

        $response->assertOk();
    }

    public function test_it_can_retrieve_a_single_category()
    {
        $category = Category::factory()->create();

        $response = $this->getJson(route('categories.show', $category->id));

        $response->assertOk()
            ->assertJsonFragment(['id' => $category->id, 'name' => $category->name]);
    }

    public function test_it_can_create_a_category()
    {
        $data = ['name' => 'New Category'];

        $response = $this->postJson(route('categories.store'), $data);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'New Category']);

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_it_can_update_a_category()
    {
        $category = Category::factory()->create();
        $updatedData = ['name' => 'Updated Category'];

        $response = $this->putJson(route('categories.update', $category->id), $updatedData);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'Updated Category']);

        $this->assertDatabaseHas('categories', $updatedData);
    }

    public function test_it_can_delete_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson(route('categories.destroy', $category->id));

        $response->assertNoContent();
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
