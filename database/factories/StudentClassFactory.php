<?php

namespace Database\Factories;

use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentClassFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudentClass::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $first_graduation_year = 2023;
        return [
            'name' => $this->faker->sentence(1),
            'graduation_year' => $first_graduation_year++
        ];
    }
}
