<?php

namespace Tests\Unit;

use App\Models\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function test_return_ok_when_accessing_root()
    {
        $response = $this->get('/api/categories');
        $response->assertStatus(200);
    }

    public function test_return_error_when_posting_without_name()
    {
        $response = $this->post('/api/categories', []);

        $response->assertStatus(302);
    }

    public function test_return_ok_when_posting_with_name()
    {
        $response = $this->post('/api/categories', [
            'name' => 'Test Category',
        ]);

        $category = Category::where('name', 'Test Category')->first();

        $this->assertNotNull($category);

        $response->assertStatus(201);
    }

    public function test_return_error_when_updating_nonexistent_category()
    {
        $response = $this->put('/api/categories/999', [
            'name' => 'Updated Category',
            'description' => 'Updated description',
        ]);

        $response->assertStatus(404);
    }

    public function test_return_ok_when_showing_category()
    {
        $response = $this->get('/api/categories');

        $response->assertStatus(200);
    }

    public function test_return_error_when_showing_nonexistent_category()
    {
        $response = $this->get('/api/categories/999');

        $response->assertStatus(404);
    }
  }