<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Partner::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $polygonA = [fake()->longitude(), fake()->latitude()];
        $polygonB = [fake()->longitude(), fake()->latitude()];
        $polygonC = [fake()->longitude(), fake()->latitude()];

        return [
            'public_id' => fake()->uuid(),
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
    }
}
