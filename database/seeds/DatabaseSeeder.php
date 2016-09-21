<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ProductsForEachCategoryTableSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(CouponTableSeeder::class);
    }
}
