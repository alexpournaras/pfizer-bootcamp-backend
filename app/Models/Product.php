<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;

	protected $casts = [
		'active_ingredients' => 'array',
		'manufactured_at' => 'date',
		'expired_at' => 'date',
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function status()
	{
		return $this->belongsTo(Status::class);
	}
}
