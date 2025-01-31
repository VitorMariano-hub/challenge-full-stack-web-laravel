<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'ra' => $this->faker->unique()->numberBetween(10000, 99999), // Gere um número de RA de 5 dígitos
            'cpf' => $this->faker->unique()->numerify('###########'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
