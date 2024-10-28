<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test listing all products.
     */
    public function test_can_list_products()
    {
        Product::factory()->count(5)->create();

        $response = $this->getJson('/api/products');
        $response->assertStatus(200)
                 ->assertJsonCount(5, 'items');
    }

    /**
     * Test searching products by search term.
     */
    public function test_can_search_products()
    {
        $product = Product::factory()->create(['name' => 'Special Product']);
        $otherProduct = Product::factory()->create(['name' => 'Other Product']);

        $response = $this->getJson('/api/products?search=Special');

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Special Product'])
                 ->assertJsonMissing(['name' => 'Other Product']);
    }

    /**
     * Test creating a new product.
     */
    public function test_can_create_product()
    {
        $data = [
            'name' => $this->faker->word,
            'category' => $this->faker->word,
            'active_ingredients' => ['ingredient1', 'ingredient2'],
            'batch_number' => $this->faker->unique()->numerify('BATCH###'),
            'research_status' => 'In Progress',
            'manufacturing_date' => now()->subDays(10)->format('Y-m-d'),
            'expiration_date' => now()->addYear()->format('Y-m-d'),
        ];

         $response = $this->postJson('/api/products', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['message' => "The product has been created!"]); // Match the actual response structure

        $this->assertDatabaseHas('products', [
            'name' => $data['name'],
            'batch_number' => $data['batch_number'],
        ]);
    }

    /**
     * Test showing a single product.
     */
    public function test_can_show_product()
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $product->id,
                     'name' => $product->name,
                 ]);
    }

    /**
     * Test updating a product.
     */
    public function test_can_update_product()
    {
        $product = Product::factory()->create();

        $data = [
            'name' => 'Updated Name',
            'category' => 'Updated Category',
            'active_ingredients' => ['ingredient3'],
            'batch_number' => 'NEWBATCH001',
            'research_status' => 'Completed',
            'manufacturing_date' => now()->subDays(20)->format('Y-m-d'),
            'expiration_date' => now()->addYear()->format('Y-m-d'),
        ];

        $response = $this->putJson("/api/products/{$product->id}", $data);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'The product has been updated!']);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Name',
            'batch_number' => 'NEWBATCH001',
        ]);
    }

    /**
     * Test deleting a product.
     */
    public function test_can_delete_product()
    {
        $product = Product::factory()->create();
        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'The product has been deleted!']);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
