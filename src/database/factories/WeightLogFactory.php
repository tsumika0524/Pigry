<?php

namespace Database\Factories;

use App\Models\WeightLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    protected $model = WeightLog::class;

    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTimeBetween('-60 days', 'now')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1, 45, 85), // decimal(4,1)範囲内
            'calories' => $this->faker->numberBetween(800, 2500),
            'exercise_time' => $this->faker->time('H:i:s'), // time型に合わせる
            'exercise_content' => $this->faker->optional()->realText(30),
        ];
    }
}
