<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for($i=0;$i<5;$i++){
            $brand = \App\Models\ProductBrands::factory()->create();
            $category = \App\Models\ProductCategories::factory()->create();
            
            \App\Models\Product::factory(2)->for($brand,'brand')->for($category, 'category')->create();
        }
        
    }
}
