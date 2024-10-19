<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;

	/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
		'category',
		'active_ingredients',
		'batch_number',
		'research_status',
		'manufacturing_date',
		'expiration_date',
    ];

	protected $casts = [
		'active_ingredients' => 'array',
		'manufacturing_date' => 'date',
		'expiration_date' => 'date',
	];
}
