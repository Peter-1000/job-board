<?php

namespace Tests\Feature;

use App\Enums\JobStatusEnum;
use App\Enums\JobTypeEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobAttributesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_job_enums()
    {
        $response = $this->getJson(route('job-attributes'));
        $response->assertOk();
    }
}
