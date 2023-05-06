<?php

namespace Tests\Feature\Partners;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function test_the_application_returns_status_ok(): void
    {
        $partner = [
            'trading_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverage_area' => [
                'type' => 'MultiPolygon',
                'coordinates' => [
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                ],
            ],
            'address' => [
                'type' => 'Point',
                'coordinates' => [fake()->longitude(), fake()->latitude()],
            ],
        ];

        $request = $this->postJson('/api/partners', $partner);

        $request->assertOk();
    }

    /**
     * @test
     */
    public function test_the_application_returns_a_valid_json_structure(): void
    {
        $partner = [
            'trading_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverage_area' => [
                'type' => 'MultiPolygon',
                'coordinates' => [
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                ],
            ],
            'address' => [
                'type' => 'Point',
                'coordinates' => [fake()->longitude(), fake()->latitude()],
            ],
        ];

        $request = $this->postJson('/api/partners', $partner);

        $request->assertOk();

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
    public function test_the_application_returns_a_correct_number_of_partners(): void
    {
        $partner = [
            'trading_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverage_area' => [
                'type' => 'MultiPolygon',
                'coordinates' => [
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                ],
            ],
            'address' => [
                'type' => 'Point',
                'coordinates' => [fake()->longitude(), fake()->latitude()],
            ],
        ];

        $request = $this->postJson('/api/partners', $partner);

        $request->assertOk();

        /**
         * In this case the partner factory generate only one partner that will be plain send
         * in 'data', so the count will be exactly the same elements from resource, in this case
         * will be 6.
         *
         * @author eng-gabrielscardoso
         */
        $request->assertJsonCount(6, 'data');
    }

    /**
     * @test
     */
    public function test_the_application_returns_a_new_partner(): void
    {
        $partner = [
            'trading_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverage_area' => [
                'type' => 'MultiPolygon',
                'coordinates' => [
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude(), fake()->latitude()],
                ],
            ],
            'address' => [
                'type' => 'Point',
                'coordinates' => [fake()->longitude(), fake()->latitude()],
            ],
        ];

        $request = $this->postJson('/api/partners', $partner);

        $request->assertOk();

        $request->assertJsonFragment([
            // 'id' => $partner->public_id,
            'trading_name' => $partner['trading_name'],
            'owner_name' => $partner['owner_name'],
            'document' => $partner['document'],
            'coverage_area' => $partner['coverage_area'],
            'address' => $partner['address'],
        ]);
    }
}
