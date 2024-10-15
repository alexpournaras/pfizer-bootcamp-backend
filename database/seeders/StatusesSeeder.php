<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$statuses = [
			['slug' => 'under_development', 'name' => 'Under Development'],
			['slug' => 'in_clinical_trials', 'name' => 'In Clinical Trials'],
			['slug' => 'completed', 'name' => 'Completed']
		];

		foreach ($statuses as $status) {
			Status::create($status);
		}
	}
}
