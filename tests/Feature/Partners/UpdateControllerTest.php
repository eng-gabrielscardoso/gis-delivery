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
     * Test if the application returns an updated partner
     *
     * @return void
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
