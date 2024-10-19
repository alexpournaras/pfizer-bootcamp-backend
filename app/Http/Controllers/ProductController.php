<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$search = $request->input('search');

		$products = Product::when($search, function ($query, $search) {
			$query->where('name', 'like', '%' . $search . '%')
				->orWhere('batch_number', 'like', '%' . $search . '%')
				->orWhere('category', 'like', '%' . $search . '%')
				->orWhere('research_status', 'like', '%' . $search . '%')
				->orWhereJsonContains('active_ingredients', $search);
		})->get();

		return response()->json($products, 200);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(ProductStoreRequest $request)
	{
		$product = Product::create($request->only(
			'name',
			'category',
			'active_ingredients',
			'batch_number',
			'research_status',
			'manufacturing_date',
			'expiration_date',
		));

		return response()->json([
			'id' => $product->id,
			'message' => 'The product has been created!
		'], 201);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Product $product)
	{
		return response()->json($product, 200);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(ProductUpdateRequest $request, Product $product)
	{
		$product->update($request->only(
			'name',
			'category',
			'active_ingredients',
			'batch_number',
			'research_status',
			'manufacturing_date',
			'expiration_date',
		));

		return response()->json(['message' => 'The product has been updated!'], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Product $product)
	{
		$product->delete();

		return response()->json(['message' => 'The product has been deleted!'], 200);
	}
}
