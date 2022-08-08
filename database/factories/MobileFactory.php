<?php

namespace Database\Factories;

use App\Models\Mobile;
use Illuminate\Database\Eloquent\Factories\Factory;

class MobileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => Mobile::TYPE_RANDOM,
            'mobile' => $this->faker->phoneNumber(),
        ];
    }
}
