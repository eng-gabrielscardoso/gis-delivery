<?php

namespace Tests\Feature\Partners;

use App\Models\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function test_the_application_returns_status_ok(): void
    {
        $partner = Partner::factory()->create();

        $updatedData = [
            'trading_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverage_area' => [
                'type' => 'MultiPolygon',
                'coordinates' => [
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude() + 0.01, fake()->latitude()],
                    [fake()->longitude() + 0.01, fake()->latitude() + 0.01],
                    [fake()->longitude(), fake()->latitude() + 0.01],
                    [fake()->longitude(), fake()->latitude()],
                ],
            ],
            'address' => [
                'type' => 'Point',
                'coordinates' => [fake()->longitude, fake()->latitude],
            ],
        ];

        $request = $this->patchJson("/api/partners/{$partner->public_id}", $updatedData);

        $request->assertOk();
    }

    /**
     * @test
     */
    public function test_the_application_returns_a_valid_json_structure(): void
    {
        $partner = Partner::factory()->create();

        $updatedData = [
            'trading_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverage_area' => [
                'type' => 'MultiPolygon',
                'coordinates' => [
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude() + 0.01, fake()->latitude()],
                    [fake()->longitude() + 0.01, fake()->latitude() + 0.01],
                    [fake()->longitude(), fake()->latitude() + 0.01],
                    [fake()->longitude(), fake()->latitude()],
                ],
            ],
            'address' => [
                'type' => 'Point',
                'coordinates' => [fake()->longitude, fake()->latitude],
            ],
        ];

        $request = $this->patchJson("/api/partners/{$partner->public_id}", $updatedData);

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
        $partner = Partner::factory()->create();

        $updatedData = [
            'trading_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverage_area' => [
                'type' => 'MultiPolygon',
                'coordinates' => [
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude() + 0.01, fake()->latitude()],
                    [fake()->longitude() + 0.01, fake()->latitude() + 0.01],
                    [fake()->longitude(), fake()->latitude() + 0.01],
                    [fake()->longitude(), fake()->latitude()],
                ],
            ],
            'address' => [
                'type' => 'Point',
                'coordinates' => [fake()->longitude, fake()->latitude],
            ],
        ];

        $request = $this->patchJson("/api/partners/{$partner->public_id}", $updatedData);

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
    public function test_the_application_returns_a_updated_partner(): void
    {
        $partner = Partner::factory()->create();

        $updatedData = [
            'trading_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverage_area' => [
                'type' => 'MultiPolygon',
                'coordinates' => [
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude() + 0.01, fake()->latitude()],
                    [fake()->longitude() + 0.01, fake()->latitude() + 0.01],
                    [fake()->longitude(), fake()->latitude() + 0.01],
                    [fake()->longitude(), fake()->latitude()],
                ],
            ],
            'address' => [
                'type' => 'Point',
                'coordinates' => [fake()->longitude, fake()->latitude],
            ],
        ];

        $request = $this->patchJson("/api/partners/{$partner->public_id}", $updatedData);

        $request->assertOk();

        $request->assertJsonFragment([
            'id' => $partner->public_id,
            'trading_name' => $updatedData['trading_name'],
            'owner_name' => $updatedData['owner_name'],
            'document' => $updatedData['document'],
            'coverage_area' => $updatedData['coverage_area'],
            'address' => $updatedData['address'],
        ]);

        $request->assertJsonMissing([
            'trading_name' => $partner->trading_name,
            'owner_name' => $partner->owner_name,
            'document' => $partner->document,
            'coverage_area' => $partner->coverage_area,
            'address' => $partner->address,
        ]);
    }
}
