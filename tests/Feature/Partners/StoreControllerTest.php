<?php

namespace Tests\Feature\Partners;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function test_the_application_returns_status_created(): void
    {
        $polygonA = [fake()->longitude(), fake()->latitude()];
        $polygonB = [fake()->longitude(), fake()->latitude()];
        $polygonC = [fake()->longitude(), fake()->latitude()];

        $partner = [
            'trading_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverage_area' => [
                'type' => 'MultiPolygon',
                'coordinates' => [
                    [
                        [
                            $polygonA,
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            $polygonA,
                        ],
                    ],
                    [
                        [
                            $polygonB,
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            $polygonB,
                        ],
                        [
                            $polygonC,
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            $polygonC,
                        ],
                    ],
                ],
            ],
            'address' => [
                'type' => 'Point',
                'coordinates' => [fake()->longitude(), fake()->latitude()],
            ],
        ];

        $request = $this->postJson('/api/partners', $partner);

        $request->assertCreated();
    }

    /**
     * @test
     */
    public function test_the_application_returns_a_valid_json_structure(): void
    {
        $polygonA = [fake()->longitude(), fake()->latitude()];
        $polygonB = [fake()->longitude(), fake()->latitude()];
        $polygonC = [fake()->longitude(), fake()->latitude()];

        $partner = [
            'trading_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverage_area' => [
                'type' => 'MultiPolygon',
                'coordinates' => [
                    [
                        [
                            $polygonA,
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            $polygonA,
                        ],
                    ],
                    [
                        [
                            $polygonB,
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            $polygonB,
                        ],
                        [
                            $polygonC,
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            $polygonC,
                        ],
                    ],
                ],
            ],
            'address' => [
                'type' => 'Point',
                'coordinates' => [fake()->longitude(), fake()->latitude()],
            ],
        ];

        $request = $this->postJson('/api/partners', $partner);

        $request->assertCreated();

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
        $polygonA = [fake()->longitude(), fake()->latitude()];
        $polygonB = [fake()->longitude(), fake()->latitude()];
        $polygonC = [fake()->longitude(), fake()->latitude()];

        $partner = [
            'trading_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverage_area' => [
                'type' => 'MultiPolygon',
                'coordinates' => [
                    [
                        [
                            $polygonA,
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            $polygonA,
                        ],
                    ],
                    [
                        [
                            $polygonB,
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            $polygonB,
                        ],
                        [
                            $polygonC,
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            $polygonC,
                        ],
                    ],
                ],
            ],
            'address' => [
                'type' => 'Point',
                'coordinates' => [fake()->longitude(), fake()->latitude()],
            ],
        ];

        $request = $this->postJson('/api/partners', $partner);

        $request->assertCreated();

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
        $polygonA = [fake()->longitude(), fake()->latitude()];
        $polygonB = [fake()->longitude(), fake()->latitude()];
        $polygonC = [fake()->longitude(), fake()->latitude()];

        $partner = [
            'trading_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'document' => strval(fake()->numerify('#############/####')),
            'coverage_area' => [
                'type' => 'MultiPolygon',
                'coordinates' => [
                    [
                        [
                            $polygonA,
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            $polygonA,
                        ],
                    ],
                    [
                        [
                            $polygonB,
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            $polygonB,
                        ],
                        [
                            $polygonC,
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            [fake()->longitude(), fake()->latitude()],
                            $polygonC,
                        ],
                    ],
                ],
            ],
            'address' => [
                'type' => 'Point',
                'coordinates' => [fake()->longitude(), fake()->latitude()],
            ],
        ];

        $request = $this->postJson('/api/partners', $partner);

        $request->assertCreated();

        $request->assertJsonFragment([
            'id' => Arr::get($request['data'], 'id'),
            'trading_name' => Arr::get($partner, 'trading_name'),
            'owner_name' => Arr::get($partner, 'owner_name'),
            'document' => Arr::get($partner, 'document'),
            'coverage_area' => Arr::get($partner, 'coverage_area'),
            'address' => Arr::get($partner, 'address'),
        ]);
    }
}
