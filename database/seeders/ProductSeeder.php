<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'Azeite de Oliva',
            'Arroz',
            'Feijão',
            'Macarrão',
            'Farinha de Trigo',
            'Açúcar',
            'Café',
            'Leite',
            'Óleo de Soja',
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product,
                'description' => 'Descrição do produto ' . $product,
                'manufacturing_date' => now(),
                'expiration_date' => now()->addDays(30),
                'quantity' => 100,
            ]);
        }
    }
}
