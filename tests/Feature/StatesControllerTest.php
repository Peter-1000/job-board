<?php

namespace Tests\Feature;

use App\Models\State;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_states()
    {
        State::factory()->count(5)->create();

        $response = $this->getJson(route('states.index'));

        $response->assertOk();
    }

    public function test_it_can_show_a_state()
    {
        $state = State::factory()->create();

        $response = $this->getJson(route('states.show', $state->id));

        $response->assertOk()
            ->assertJson(['data' => ['id' => $state->id, 'name' => $state->name]]);
    }

    public function test_it_returns_404_when_showing_non_existing_state()
    {
        $response = $this->getJson(route('states.show', 9999));

        $response->assertNotFound();
    }

    public function test_it_can_create_a_state()
    {
        $country = Country::factory()->create();

        $data = [
            'name' => 'New State',
            'code' => 'NS',
            'country_id' => $country->id
        ];

        $response = $this->postJson(route('states.store'), $data);

        $response->assertCreated()
            ->assertJson(['data' => ['name' => 'New State']]);

        $this->assertDatabaseHas('states', ['name' => 'New State']);
    }

    public function test_it_requires_name_and_country_id_to_create_a_state()
    {
        $response = $this->postJson(route('states.store'), []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'country_id']);
    }

    public function test_it_can_update_a_state()
    {
        $state = State::factory()->create();
        $country = Country::factory()->create();

        $data = [
            'name' => 'Updated State',
            'code' => 'US',
            'country_id' => $country->id
        ];

        $response = $this->putJson(route('states.update', $state->id), $data);

        $response->assertOk()
            ->assertJson(['data' => ['name' => 'Updated State']]);

        $this->assertDatabaseHas('states', ['id' => $state->id, 'name' => 'Updated State']);
    }

    public function test_it_can_delete_a_state()
    {
        $state = State::factory()->create();

        $response = $this->deleteJson(route('states.destroy', $state->id));

        $response->assertNoContent();

        $this->assertDatabaseMissing('states', ['id' => $state->id]);
    }

    public function test_it_returns_404_when_deleting_non_existing_state()
    {
        $response = $this->deleteJson(route('states.destroy', 9999));

        $response->assertNotFound();
    }
}
