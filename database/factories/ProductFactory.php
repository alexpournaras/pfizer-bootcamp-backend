<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Status;
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
			'category_id' => Category::inRandomOrder()->first()->id,
			'status_id' => Status::inRandomOrder()->first()->id,
			'active_ingredients' => $this->faker->randomElements(
				['Ingredient 1', 'Ingredient 2', 'Ingredient 3', 'Ingredient 4'], 
				rand(2, 4)
			),
			'batch_number' => strtoupper(Str::random(10)),
			'manufactured_at' => Carbon::parse($this->faker->date),
			'expired_at' => Carbon::parse($this->faker->date)->addYears(rand(2, 4)),
		];
	}
}
