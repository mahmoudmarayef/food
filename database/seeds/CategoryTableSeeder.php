<?php

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Category::insert([
            ['name' => 'Vegetables', 'slug' => 'vegetables', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fruits', 'slug' => 'fruits', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Juices', 'slug' => 'juices', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Nuts', 'slug' => 'nuts', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Legumes', 'slug' => 'legumes', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Detergents', 'slug' => 'detergents', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
