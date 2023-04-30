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
     * Test if the application returns status 200
     */
    public function test_the_application_returns_status_ok(): void
    {
        $partner = Partner::factory()->create();

        $updatedData = [
            'tradingName' => fake()->company(),
            'ownerName' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverageArea' => [
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
     * Test if the application returns a valid JSON structure
     */
    public function test_the_application_returns_a_valid_json_structure(): void
    {
        $partner = Partner::factory()->create();

        $updatedData = [
            'tradingName' => fake()->company(),
            'ownerName' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverageArea' => [
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
                'tradingName',
                'ownerName',
                'document',
                'coverageArea' => [
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
     * Test if the application returns a correct number of partners
     */
    public function test_the_application_returns_a_correct_number_of_partners(): void
    {
        $partner = Partner::factory()->create();

        $updatedData = [
            'tradingName' => fake()->company(),
            'ownerName' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverageArea' => [
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
     * Test if the application returns an updated partner
     */
    public function test_the_application_returns_a_updated_partner(): void
    {
        $partner = Partner::factory()->create();

        $updatedData = [
            'tradingName' => fake()->company(),
            'ownerName' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverageArea' => [
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
            'tradingName' => $updatedData['tradingName'],
            'ownerName' => $updatedData['ownerName'],
            'document' => $updatedData['document'],
            'coverageArea' => $updatedData['coverageArea'],
            'address' => $updatedData['address'],
        ]);

        $request->assertJsonMissing([
            'tradingName' => $partner->trading_name,
            'ownerName' => $partner->owner_name,
            'document' => $partner->document,
            'coverageArea' => $partner->coverage_area,
            'address' => $partner->address,
        ]);
    }
}
