<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'name' => 'sometimes|string',
			'category' => 'sometimes|string',
			'active_ingredients' => 'sometimes|array',
			'batch_number' => [
				'sometimes',
				'string',
				Rule::unique('products')->ignore($this->product),
			],
			'research_status' => 'sometimes|string',
			'manufacturing_date' => 'sometimes|date',
			'expiration_date' => 'sometimes|date|after:manufacturing_date',
		];
	}
}
