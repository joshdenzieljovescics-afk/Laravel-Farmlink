<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Fresh Organic Tomatoes',
                'description' => 'Vine-ripened organic tomatoes grown with sustainable farming practices. Perfect for salads, cooking, and canning.',
                'price' => 4.99,
                'unit' => 'per kg',
                'category' => 'Vegetables',
                'farm_name' => 'Green Valley Farm',
                'image_path' => 'https://images.unsplash.com/photo-1546470427-e190e1204b75?w=400',
                'stock_quantity' => 150,
                'is_active' => true,
                'is_organic' => true,
            ],
            [
                'name' => 'Free-Range Chicken Eggs',
                'description' => 'Fresh eggs from free-range chickens. Rich in protein and perfect for breakfast, baking, and cooking.',
                'price' => 6.50,
                'unit' => 'per dozen',
                'category' => 'Dairy & Eggs',
                'farm_name' => 'Sunrise Poultry Farm',
                'image_path' => 'https://images.unsplash.com/photo-1518569656558-1f25e69d93d7?w=400',
                'stock_quantity' => 80,
                'is_active' => true,
                'is_organic' => false,
            ],
            [
                'name' => 'Organic Carrots',
                'description' => 'Sweet and crunchy organic carrots, freshly harvested. Great for snacking, cooking, and juicing.',
                'price' => 3.25,
                'unit' => 'per kg',
                'category' => 'Vegetables',
                'farm_name' => 'Root & Leaf Organics',
                'image_path' => 'https://images.unsplash.com/photo-1445282768818-728615cc910a?w=400',
                'stock_quantity' => 200,
                'is_active' => true,
                'is_organic' => true,
            ],
            [
                'name' => 'Grass-Fed Beef Steaks',
                'description' => 'Premium grass-fed beef steaks from locally raised cattle. Tender, flavorful, and ethically sourced.',
                'price' => 28.99,
                'unit' => 'per kg',
                'category' => 'Meat',
                'farm_name' => 'Highland Cattle Ranch',
                'image_path' => 'https://images.unsplash.com/photo-1588347818636-f81d5891cd7d?w=400',
                'stock_quantity' => 45,
                'is_active' => true,
                'is_organic' => false,
            ],
            [
                'name' => 'Artisan Goat Cheese',
                'description' => 'Creamy artisan goat cheese made from fresh goat milk. Perfect for cheese boards and gourmet cooking.',
                'price' => 12.75,
                'unit' => 'per 200g',
                'category' => 'Dairy & Eggs',
                'farm_name' => 'Mountain View Dairy',
                'image_path' => 'https://images.unsplash.com/photo-1486297678162-eb2a19b0a32d?w=400',
                'stock_quantity' => 30,
                'is_active' => true,
                'is_organic' => true,
            ],
            [
                'name' => 'Fresh Strawberries',
                'description' => 'Juicy, sweet strawberries picked at peak ripeness. Perfect for desserts, smoothies, and fresh eating.',
                'price' => 8.99,
                'unit' => 'per 500g',
                'category' => 'Fruits',
                'farm_name' => 'Berry Patch Farm',
                'image_path' => 'https://images.unsplash.com/photo-1464965911861-746a04b4bca6?w=400',
                'stock_quantity' => 75,
                'is_active' => true,
                'is_organic' => false,
            ],
            [
                'name' => 'Organic Spinach',
                'description' => 'Fresh organic spinach leaves, rich in iron and vitamins. Great for salads, smoothies, and cooking.',
                'price' => 5.50,
                'unit' => 'per bunch',
                'category' => 'Vegetables',
                'farm_name' => 'Green Leaf Gardens',
                'image_path' => 'https://images.unsplash.com/photo-1576045057995-568f588f82fb?w=400',
                'stock_quantity' => 120,
                'is_active' => true,
                'is_organic' => true,
            ],
            [
                'name' => 'Honey (Raw Wildflower)',
                'description' => 'Pure raw wildflower honey from local beehives. Unprocessed and full of natural enzymes and antioxidants.',
                'price' => 15.99,
                'unit' => 'per 500ml jar',
                'category' => 'Pantry',
                'farm_name' => 'Golden Hive Apiary',
                'image_path' => 'https://images.unsplash.com/photo-1587049352851-8d4e89133924?w=400',
                'stock_quantity' => 60,
                'is_active' => true,
                'is_organic' => true,
            ],
            [
                'name' => 'Organic Apples',
                'description' => 'Crisp and sweet organic apples, perfect for snacking, baking, and juice making.',
                'price' => 6.25,
                'unit' => 'per kg',
                'category' => 'Fruits',
                'farm_name' => 'Orchard Hills Farm',
                'image_path' => 'https://images.unsplash.com/photo-1560806887-1e4cd0b6cbd6?w=400',
                'stock_quantity' => 180,
                'is_active' => true,
                'is_organic' => true,
            ],
            [
                'name' => 'Fresh Herbs Mix',
                'description' => 'A mix of fresh herbs including basil, parsley, cilantro, and mint. Perfect for cooking and garnishing.',
                'price' => 7.50,
                'unit' => 'per pack',
                'category' => 'Herbs',
                'farm_name' => 'Herb Heaven Farm',
                'image_path' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=400',
                'stock_quantity' => 90,
                'is_active' => true,
                'is_organic' => true,
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
