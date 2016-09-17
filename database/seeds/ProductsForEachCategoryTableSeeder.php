<?php

use Illuminate\Database\Seeder;

class ProductsForEachCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Delivery\Models\Category::class, 10)->create()->each(function($c) {
        	foreach (range(1,10) as $i) {
        		$c->products()->save(factory(Delivery\Models\Product::class)->make());
        	}
        });
    }
}
