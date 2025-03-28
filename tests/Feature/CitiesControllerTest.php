<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\State;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CitiesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_cities()
    {
        City::factory()->count(5)->create();

        $response = $this->getJson(route('cities.index'));

        $response->assertOk();
    }

    public function test_it_can_retrieve_a_single_city()
    {
        $city = City::factory()->create();

        $response = $this->getJson(route('cities.show', $city->id));

        $response->assertOk()
            ->assertJsonFragment(['id' => $city->id, 'name' => $city->name]);
    }

    public function test_it_can_create_a_city()
    {
        $state = State::factory()->create();
        $data = [
            'name' => 'New City',
            'state_id' => $state->id,
        ];

        $response = $this->postJson(route('cities.store'), $data);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'New City']);

        $this->assertDatabaseHas('cities', $data);
    }

    public function test_it_can_update_a_city()
    {
        $city = City::factory()->create();
        $state = State::factory()->create();
        $updatedData = [
            'name' => 'Updated City',
            'state_id' => $state->id,
        ];
        $response = $this->putJson(route('cities.update', $city->id), $updatedData);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'Updated City']);

        $this->assertDatabaseHas('cities', $updatedData);
    }

    public function test_it_can_delete_a_city()
    {
        $city = City::factory()->create();

        $response = $this->deleteJson(route('cities.destroy', $city->id));

        $response->assertNoContent();
        $this->assertDatabaseMissing('cities', ['id' => $city->id]);
    }
}
