<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function testIndexProductsReturnsProducts()
    {
        Product::factory()->count(10)->create();

        $response = $this->getJson('/api/products');

        $response->assertJson(fn (AssertableJson $json) => 
            $json->has("data", 10, fn ($json) => 
                $json->hasAll(["id", "name", "description", "price", "categories"])
            )
        );
    }

    public function testCreateProductPersistsProduct()
    {
        $data = [
            "name" => "test",
            "description" => "test description", 
            "price" => 120.9
        ];

        $this->postJson("/api/products", $data);
        $this->assertDatabaseHas("products", $data);
    }

    public function testUpdateProductRouteUpdatesProduct()
    {
        $product = Product::create([
            "name" => "test",
            "description" => "test description",
            "price" => 120,
        ]);

        $this->patchJson("/api/products/{$product->id}", [
            "name" => "new name"
        ]);

        $this->assertDatabaseHas("products", [
            "id" => $product->id,
            "name" => "new name"
        ]);
    }


}
