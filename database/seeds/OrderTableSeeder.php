<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Delivery\Models\Order::class, 10)->create()->each(function($o) {
        	foreach (range(1,3) as $i) {
        		$o->items()->save(factory(\Delivery\Models\OrderItem::class)->make([
                    'product_id' => rand(1,100),
                    'qtd' => rand(2,10),
                    'price' => rand(50,100)
                ]));
        	}
        });
    }
}
