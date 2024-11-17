<?php

namespace AlRimi\Submit\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use AlRimi\Submit\Models\Student;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * This factory is tied to the Student model and is used to generate
     * mock data for testing or seeding the database with initial values.
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * This method returns the default values for the Student model's attributes.
     * These values are generated using Faker, which provides realistic mock data.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            /*
            |--------------------------------------------------------------------------
            | Student ID
            |--------------------------------------------------------------------------
            |
            | The `student_id` field is a unique identifier for each student.
            | This factory generates a random 10-digit numeric string for
            | this field using the Faker library's `numerify` method.
            |
            */
            'student_id' => $this->faker->unique()->numerify('##########'),

            /*
            |--------------------------------------------------------------------------
            | Student Name
            |--------------------------------------------------------------------------
            |
            | The `student_name` field stores the name of the student.
            | This value is generated using the Faker library's `name` method,
            | which creates realistic names for testing purposes.
            |
            */
            'student_name' => $this->faker->name(),

            /*
            |--------------------------------------------------------------------------
            | Submit Count
            |--------------------------------------------------------------------------
            |
            | The `submit_count` field keeps track of how many submissions
            | the student has made. By default, this is set to `0` to
            | represent no submissions when the student record is created.
            |
            */
            'submit_count' => 0,
        ];
    }
}
