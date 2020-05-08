<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Vegetables
        for ($i = 1; $i <= 30; $i++) {
            Product::create([
                'name' => 'Vegetables' . $i,
                'slug' => 'vegetables-' . $i,
                'details' => 'Fresh natural vegetables picked from our farms',
                'price' => rand(149999, 249999),
                'description' => 'Loren ' . $i . ' ipsun dolor sit anet, consectetur adipisicing elit. Ipsun tenporibus iusto ipsa, asperiores
                voluptas unde aspernatur praesentium in? Aliquan, dolore',
                'image' => 'products/dummy/vegetables-'.$i.'.jpg',
                'images' => '["products\/dummy\/laptop-2.jpg","products\/dummy\/laptop-3.jpg","products\/dummy\/laptop-4.jpg"]',
            ])->categories()->attach(1);
        }

        $product = Product::find(1);
        $product->categories()->attach(2);

        // Fruits
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Fruits' . $i,
                'slug' => 'fruits-' . $i,
                'details' => 'Fresh natural fruits picked from our farms',
                'price' => rand(249999, 449999),
                'description' => 'Loren ' . $i . ' ipsun dolor sit anet, consectetur adipisicing elit. Ipsun tenporibus iusto ipsa, asperiores
                voluptas unde aspernatur praesentium in? Aliquan, dolore',
                'image' => 'products/dummy/fruits-'.$i.'.jpg',
                'images' => '["products\/dummy\/desktop-2.jpg","products\/dummy\/desktop-3.jpg","products\/dummy\/desktop-4.jpg"]',
            ])->categories()->attach(2);
        }

        // Juices
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Juices ' . $i,
                'slug' => 'juices-' . $i,
                'details' => 'Fresh natural Juices picked from our store',
                'price' => rand(79999, 149999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'image' => 'products/dummy/juices-'.$i.'.jpg',
                'images' => '["products\/dummy\/phone-2.jpg","products\/dummy\/phone-3.jpg","products\/dummy\/phone-4.jpg"]',
            ])->categories()->attach(3);
        }

        // Nuts
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Nuts ' . $i,
                'slug' => 'nuts-' . $i,
                'details' => 'Fresh natural nuts picked from our store',
                'price' => rand(49999, 149999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'image' => 'products/dummy/nuts-'.$i.'.jpg',
                'images' => '["products\/dummy\/tablet-2.jpg","products\/dummy\/tablet-3.jpg","products\/dummy\/tablet-4.jpg"]',
            ])->categories()->attach(4);
        }

        // Legumes
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Legumes ' . $i,
                'slug' => 'legumes-' . $i,
                'details' => 'Fresh natural Legumes picked from our store',
                'price' => rand(79999, 149999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'image' => 'products/dummy/legumes-'.$i.'.jpg',
                'images' => '["products\/dummy\/tv-2.jpg","products\/dummy\/tv-3.jpg","products\/dummy\/tv-4.jpg"]',
            ])->categories()->attach(5);
        }

        // Detergents
        for ($i = 1; $i <= 9; $i++) {
            Product::create([
                'name' => 'Detergents ' . $i,
                'slug' => 'detergents-' . $i,
                'details' => 'Fresh natural detergents picked from our store',
                'price' => rand(79999, 249999),
                'description' => 'Lorem ' . $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
                'image' => 'products/dummy/detergents-'.$i.'.jpg',
                'images' => '["products\/dummy\/camera-2.jpg","products\/dummy\/camera-3.jpg","products\/dummy\/camera-4.jpg"]',
            ])->categories()->attach(6);
        }

        // Select random entries to be featured
        Product::whereIn('id', [1, 12, 22, 31, 41, 43, 47, 51, 53, 61, 69, 73, 80])->update(['featured' => true]);
    }
}
