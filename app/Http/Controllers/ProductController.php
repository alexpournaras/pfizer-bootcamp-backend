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
		$itemsPerPage = $request->input('itemsPerPage', 10);
		$page = $request->input('page', 1);
		$searchQuery = $request->input('search', '');
		$sortBy = $request->input('sortBy', 'id');
		$sortOrder = $request->input('sortOrder', 'asc');

		$query = Product::query();

		if ($searchQuery) {
			$query->where('name', 'like', '%' . $searchQuery . '%')
				->orWhere('batch_number', 'like', '%' . $searchQuery . '%')
				->orWhere('category', 'like', '%' . $searchQuery . '%')
				->orWhere('research_status', 'like', '%' . $searchQuery . '%')
				->orWhereJsonContains('active_ingredients', $searchQuery);
		}

		$query->orderBy($sortBy, $sortOrder);

		$products = $query->paginate($itemsPerPage, ['*'], 'page', $page);

		return response()->json([
			'items' => $products->items(),
			'total' => $products->total()
		], 200);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(ProductStoreRequest $request)
{
	 // The request is already validated by ProductStoreRequest

    // Check if manufacturing date is earlier than expiration date
    $manufacturingDate = \Carbon\Carbon::parse($request->manufacturing_date);
    $expirationDate = \Carbon\Carbon::parse($request->expiration_date);

    if ($manufacturingDate->greaterThanOrEqualTo($expirationDate)) {
        return response()->json(['message' => 'The expiration date must be after the manufacturing date.'], 422);
    }
    // The request is already validated by ProductStoreRequest

    // Attempt to create the product
    try {
        $product = Product::create($request->only(
            'name',
            'category',
            'active_ingredients',
            'batch_number',
            'research_status',
            'manufacturing_date',
            'expiration_date',
        ));

        return response()->json(['id' => $product->id, 'message' => 'The product has been created!'], 201);
    } catch (\Illuminate\Database\QueryException $e) {
        // Handle duplicate entry error
        if ($e->errorInfo[1] == 1062) { // Error code for duplicate entry
            return response()->json(['message' => 'Product name or Batch number already exists.'], 422);
        }

        // Handle other database exceptions
        return response()->json(['message' => 'Could not create product.'], 500);
    }
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
