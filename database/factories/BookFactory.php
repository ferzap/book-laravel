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
        return [
            //
            'title' => $this->faker->sentence(mt_rand(2,5)),
            'description' => $this->faker->paragraphs(3, true),
            'category_id' => json_encode($this->faker->randomElements(['1', '2', '3'], null)),
            'keywords' => json_encode($this->faker->randomElements(['Princess', 'Animal', 'Hospital', 'Random', 'Mechanic'], 3)),
            'price' => $this->faker->numberBetween(45000, 150000),
            'stock' => $this->faker->numberBetween(1, 99),
            'publisher' => $this->faker->name(),
        ];
    }
}
