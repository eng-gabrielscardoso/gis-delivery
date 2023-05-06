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
}
