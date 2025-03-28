<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountriesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_list_all_countries()
    {
        Country::factory()->count(5)->create();

        $response = $this->getJson(route('countries.index'));

        $response->assertOk();
    }

    public function test_it_can_retrieve_a_single_country()
    {
        $country = Country::factory()->create();

        $response = $this->getJson(route('countries.show', $country->id));

        $response->assertOk()
            ->assertJsonFragment(['id' => $country->id, 'name' => $country->name]);
    }

    public function test_it_can_create_a_country()
    {
        $data = [
            'name' => 'New Country',
            'code' => 'NCT'
        ];

        $response = $this->postJson(route('countries.store'), $data);

        $response->assertCreated()
            ->assertJsonFragment(['name' => 'New Country', 'code' => 'NCT']);

        $this->assertDatabaseHas('countries', $data);
    }

    public function test_it_can_update_a_country()
    {
        $country = Country::factory()->create();
        $updatedData = [
            'name' => 'Updated Country',
            'code' => 'UCT'
        ];

        $response = $this->putJson(route('countries.update', $country->id), $updatedData);

        $response->assertOk()
            ->assertJsonFragment(['name' => 'Updated Country', 'code' => 'UCT']);

        $this->assertDatabaseHas('countries', $updatedData);
    }

    public function test_it_can_delete_a_country()
    {
        $country = Country::factory()->create();

        $response = $this->deleteJson(route('countries.destroy', $country->id));

        $response->assertNoContent();
        $this->assertDatabaseMissing('countries', ['id' => $country->id]);
    }
}
