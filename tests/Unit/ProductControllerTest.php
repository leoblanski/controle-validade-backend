<?php

namespace Tests\Unit;

use App\Models\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function test_return_ok_when_accessing_root()
    {
        $response = $this->get('/api/products');
        $response->assertStatus(200);
    }

    public function test_return_error_when_with_expired_date()
    {
        $response = $this->post('/api/products', [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'quantity' => 10,
            'manufacturing_date' => now()->toDateString(),
            'expiration_date' => now()->subDays(1)->toDateString(),
            'category_id' => 1,
        ]);

        $response->assertStatus(422);
        $response->assertJson(['error' => 'A data de validade não pode ser anterior à data de fabricação.']);
    }


    public function test_return_ok_when_posting_with_name()
    {
        $response = $this->post('/api/products', [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'quantity' => 10,
            'manufacturing_date' => now()->toDateString(),
            'expiration_date' => now()->addDays(10)->toDateString(),
            'category_id' => 1,
        ]);

        $product = Product::where('name', 'Test Product')->first();

        $this->assertNotNull($product);

        $response->assertStatus(201);
    }
}
