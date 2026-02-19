<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $totalCopies = $this->faker->numberBetween(3, 15);
        $availableCopies = $this->faker->numberBetween(0, $totalCopies);
        $status = $availableCopies > 0;
        return [
            'title' => $this->faker->sentence(4, false),
            'description' => $this->faker->paragraph(2),
            'isbn' => $this->faker->unique()->isbn13(),
            'total_copies' => $totalCopies,
            'available_copies' => $availableCopies,
            'status' => $status,
        ];
    }
}
