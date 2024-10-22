<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;

class ProductTest extends TestCase
{
    use WithFaker;

    /**
     * Test creating a product instance and ensuring it has the correct attributes.
     */
    public function test_can_create_product_instance()
    {
        // create a product
        $product = new Product([
            'name' => 'Test Product',
            'category' => 'Test Category',
            'active_ingredients' => ['ingredient1', 'ingredient2'],
            'batch_number' => 'BATCH001',
            'research_status' => 'In Progress',
            'manufacturing_date' => Carbon::now()->subDays(10),
            'expiration_date' => Carbon::now()->addYear(),
        ]);

        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals('Test Category', $product->category);
        $this->assertEquals(['ingredient1', 'ingredient2'], $product->active_ingredients);
        $this->assertEquals('BATCH001', $product->batch_number);
        $this->assertEquals('In Progress', $product->research_status);
    }
}
