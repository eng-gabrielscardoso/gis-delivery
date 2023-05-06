<?php

namespace Tests\Feature\Partners;

use App\Models\Partner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function test_the_application_returns_status_ok(): void
    {
        $request = $this->getJson('/api/partners');

        $request->assertOk();
    }

    /**
     * @test
     */
    public function test_the_application_returns_a_valid_json_structure(): void
    {
        $partners = Partner::factory()->count(3)->create();

        $request = $this->getJson('/api/partners');

        $request->assertOk();

        /**
         * In this case the factory generate 3 partners, so the application will return
         * a data array that contains the 3 partners
         *
         * @author eng-gabrielscardoso
         */
        $request->assertJsonCount(3, 'data');

        foreach ($partners as $partner) {
            $request->assertJsonStructure([
                'data' => [
                    '*' => [
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
                ],
            ]);
        }
    }

    /**
     * @test
     */
    public function test_the_application_returns_a_correct_number_of_partners(): void
    {
        Partner::factory()->count(3)->create();

        $request = $this->getJson('/api/partners');

        $request->assertOk();

        /**
         * In this case the factory generate 3 partners, so the application will return
         * a data array that contains the 3 partners
         *
         * @author eng-gabrielscardoso
         */
        $request->assertJsonCount(3, 'data');
    }

    /**
     * @test
     */
    public function test_the_application_returns_a_collection_of_partners(): void
    {
        $partners = Partner::factory()->count(3)->create();

        $request = $this->getJson('/api/partners');

        $request->assertOk();

        /**
         * In this case the factory generate 3 partners, so the application will return
         * a data array that contains the 3 partners
         *
         * @author eng-gabrielscardoso
         */
        $request->assertJsonCount(3, 'data');

        foreach ($partners as $partner) {
            foreach ($partners as $partner) {
                $request = $this->getJson("/api/partners/{$partner->public_id}");

                $request->assertOk();

                $this->assertEquals($partner->public_id, $request['data']['id']);
                $this->assertEquals($partner->trading_name, $request['data']['trading_name']);
                $this->assertEquals($partner->owner_name, $request['data']['owner_name']);
                $this->assertEquals($partner->document, $request['data']['document']);
                $this->assertEquals($partner->coverage_area, json_decode(json_encode($request['data']['coverage_area']), true));
                $this->assertEquals($partner->address, json_decode(json_encode($request['data']['address']), true));
            }
        }
    }

    /**
     * @test
     */
    public function test_the_application_returns_a_correct_filtered_partner_by_address(): void
    {
        $pivot = Partner::factory()->create();
        $partners = Partner::factory()->count(3)->create();

        $request = $this->getJson("/api/partners?filter[address]={$pivot->address['coordinates'][0]},{$pivot->address['coordinates'][1]}");

        $request->assertOk();

        $request->assertJsonStructure([
            'data' => [
                '*' => [
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
            ],
        ]);

        $request->assertJsonCount(1, 'data');

        $request->assertJsonFragment([
            'id' => Arr::get($pivot, 'public_id'),
            'trading_name' => Arr::get($pivot, 'trading_name'),
            'owner_name' => Arr::get($pivot, 'owner_name'),
            'document' => Arr::get($pivot, 'document'),
            'coverage_area' => Arr::get($pivot, 'coverage_area'),
            'address' => Arr::get($pivot, 'address'),
        ]);
    }

    /**
     * @test
     */
    public function test_the_application_returns_filtered_partners_by_coverage_area(): void
    {
        $pivot = Partner::factory()->create();
        $partners = Partner::factory()->count(9)->create();

        $request = $this->getJson("/api/partners?filter[coverage_area]={$pivot->address['coordinates'][0]},{$pivot->address['coordinates'][1]}");

        $request->assertOk();

        $request->assertJsonStructure([
            'data' => [
                '*' => [
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
            ],
        ]);
    }
}
