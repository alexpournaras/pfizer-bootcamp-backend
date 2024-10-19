<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
			'name' => 'required|string',
			'category' => 'required|string',
			'active_ingredients' => 'required|array',
			'batch_number' => 'required|string|unique:products,batch_number',
			'research_status' => 'required|string',
			'manufacturing_date' => 'required|date',
			'expiration_date' => 'required|date|after:manufacturing_date',
		];
	}
}
