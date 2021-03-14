<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->word,
            'lastname' => $this->faker->word,
            'age' => $this->faker->numberBetween(18, 30),
            'entry_year' => $this->faker->numberBetween(2018, 2021),
            'student_class_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}
