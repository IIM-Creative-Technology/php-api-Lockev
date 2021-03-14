<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Module::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'start_date' => $this->faker->dateTimeBetween('now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+5 days'),
            'teacher_id' => $this->faker->numberBetween(1, 3),
            'student_class_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}
