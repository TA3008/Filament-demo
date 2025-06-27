<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Product::create([
                'name' => 'Sản phẩm #' . $i,
                'description' => 'Mô tả sản phẩm ' . $i . ': ' . Str::random(50),
                'price' => rand(100000, 1000000), // giá từ 100k đến 1 triệu
                'stock' => rand(1, 100), // tồn kho ngẫu nhiên
                'image' => 'https://via.placeholder.com/300x200.png?text=Product+'.urlencode($i),
                'created_at' => now()->subDays(rand(0, 180)), // 👈 Random trong 6 tháng gần đây
                'updated_at' => now(),
            ]);
        }
    }
}
