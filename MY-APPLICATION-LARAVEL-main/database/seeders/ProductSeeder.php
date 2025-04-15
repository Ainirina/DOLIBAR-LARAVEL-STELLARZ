<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Créer des catégories si elles n'existent pas déjà
        $informatique = Category::where('name', 'Informatique')->first();
        $gaming = Category::where('name', 'Gaming')->first();
        $accessoires = Category::where('name', 'Accessoires')->first();

        // Créer des produits et les associer aux catégories
        $product1 = Product::create([
            'name' => 'Laptop Gamer',
            'model' => 'GTX-1500',
            'price' => 1500.00,
        ]);
        $product1->categories()->attach($gaming->id);  // Attacher la catégorie "Gaming"

        $product2 = Product::create([
            'name' => 'Souris Gaming',
            'model' => 'X-123',
            'price' => 50.00,
        ]);
        $product2->categories()->attach($gaming->id);  // Attacher la catégorie "Gaming"

        $product3 = Product::create([
            'name' => 'Clavier Mécanique',
            'model' => 'RGB-789',
            'price' => 100.00,
        ]);
        $product3->categories()->attach([$gaming->id, $informatique->id, $accessoires->id]);  // Attacher les catégories "Gaming" et "Office"
    }
}
