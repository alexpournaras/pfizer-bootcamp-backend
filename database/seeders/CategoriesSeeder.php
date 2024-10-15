<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$categories = [
			['slug' => 'tablet', 'name' => 'Tablet'],
			['slug' => 'capsule', 'name' => 'Capsule'],
			['slug' => 'injection', 'name' => 'Injection']
		];

		foreach ($categories as $category) {
			Category::create($category);
		}
	}
}
