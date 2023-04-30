<?php

namespace Tests\Feature\Partners;

use App\Models\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test if the application returns a collection of partners
     *
     * @return void
     */
    public function test_the_application_returns_a_collection_of_partners(): void
    {
        $partners = Partner::factory()->count(3)->create();

        $response = $this->getJson('/api/partners');

        $response->assertOk();
        $response->assertJsonCount(1);

        foreach ($partners as $partner) {
            $response->assertJsonFragment([
                'id' => $partner->public_id,
                'tradingName' => $partner->trading_name,
                'ownerName' => $partner->owner_name,
                'document' => $partner->document,
                'coverageArea' => [
                    'type' => $partner->coverage_area['type'],
                    'coordinates' => $partner->coverage_area['coordinates'],
                ],
                'address' => [
                    'type' => $partner->address['type'],
                    'coordinates' => $partner->address['coordinates'],
                ],
            ]);
        }
    }
}
