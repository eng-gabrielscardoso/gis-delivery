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
     *
     * @return array
     */
    public function definition(): array
    {

        return [
            'public_id' => fake()->uuid(),
            'trading_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'document' => strval(fake()->numberBetween(100000000000, 10000000000000000)),
            'coverage_area' => [
                'type' => 'MultiPolygon',
                'coordinates' => [[[
                    [fake()->longitude(), fake()->latitude()],
                    [fake()->longitude() + 0.01, fake()->latitude()],
                    [fake()->longitude() + 0.01, fake()->latitude() + 0.01],
                    [fake()->longitude(), fake()->latitude() + 0.01],
                    [fake()->longitude(), fake()->latitude()],
                ]]],
            ],
            'address' => [
                'type' => 'Point',
                'coordinates' => [fake()->longitude(), fake()->latitude()],
            ],
        ];
    }
}
