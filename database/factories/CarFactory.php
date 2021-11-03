<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));

        return [
            'brand' => $faker->vehicleBrand(),
            'model' => $faker->unique()->vehicle(),
            'engine_size' => $this->faker->numberBetween($min = 0, $max = 99999),
            'price' => $this->faker->numberBetween($min = 1000, $max = 99999),
            'registration_date' => $this->faker->dateTimeBetween('-30 years', 'now'),
            'condition' => 'new',
        ];
    }

    // Create a popular car
    public function popular()
    {
        return $this->state([
            'popular' => true,
        ]);
    }

    // Create used car
    public function used()
    {
        return $this->state([
            'condition' => 'used',
        ]);
    }
}
