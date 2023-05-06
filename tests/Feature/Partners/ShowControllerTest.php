<?php

namespace Tests\Feature\Partners;

use App\Models\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class ShowControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function test_the_application_returns_status_ok(): void
    {
        $partner = Partner::factory()->create();

        $request = $this->getJson("/api/partners/{$partner->public_id}");

        $request->assertOk();
    }

    /**
     * @test
     */
    public function test_the_application_returns_a_valid_json_structure(): void
    {
        $partner = Partner::factory()->create();

        $request = $this->getJson("/api/partners/{$partner->public_id}");

        $request->assertOk();

        $request->assertJsonCount(6, 'data');

        $request->assertJsonStructure([
            'data' => [
                'id',
                'trading_name',
                'owner_name',
                'document',
                'coverage_area' => [
                    'type',
                    'coordinates',
                ],
                'address' => [
                    'type',
                    'coordinates',
                ],
            ],
        ]);
    }

    /**
     * @test
     */
    public function test_the_application_returns_the_correct_partner(): void
    {
        $partner = Partner::factory()->create();

        $request = $this->getJson("/api/partners/{$partner->public_id}");

        $request->assertOk();

        $request->assertJsonFragment([
            'id' => Arr::get($request['data'], 'id'),
            'trading_name' => Arr::get($request['data'], 'trading_name'),
            'owner_name' => Arr::get($request['data'], 'owner_name'),
            'document' => Arr::get($request['data'], 'document'),
            'coverage_area' => Arr::get($request['data'], 'coverage_area'),
            'address' => Arr::get($request['data'], 'address'),
        ]);
    }
}
