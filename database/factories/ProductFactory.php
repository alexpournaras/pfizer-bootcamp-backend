<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'name' => ucfirst($this->faker->word) . ' ' . $this->faker->randomElement(['Medicine', 'Med', 'Drug']),
			'category' => $this->faker->randomElement(['Tablet', 'Capsule', 'Injection']),
			'active_ingredients' => $this->faker->randomElements(
				['Ingredient 1', 'Ingredient 2', 'Ingredient 3', 'Ingredient 4'], 
				rand(2, 4)
			),
			'batch_number' => strtoupper(Str::random(10)),
			'research_status' => $this->faker->randomElement(['Under Development', 'In Clinical Trials', 'Completed']),
			'manufacturing_date' => Carbon::parse($this->faker->date),
			'expiration_date' => Carbon::parse($this->faker->date)->addYears(rand(2, 4)),
		];
	}
}
