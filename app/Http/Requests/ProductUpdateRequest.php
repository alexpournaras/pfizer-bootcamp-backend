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
        'name' => [
            'required', // Make this required
            'string',
            Rule::unique('products')->ignore($this->product->id), // Use the product's ID to ignore itself
        ],
        'category' => 'required|string', // Assuming category is required
        'active_ingredients' => 'required|array', // Assuming this field should also be required
        'batch_number' => [
            'required', // Make this required
            'string',
            Rule::unique('products')->ignore($this->product->id), // Use the product's ID to ignore itself
        ],
        'research_status' => 'required|string', // Assuming research status is required
        'manufacturing_date' => 'required|date', // Assuming this field should be required
        'expiration_date' => 'required|date|after:manufacturing_date', // Keep the existing logic
    ];
}

}
