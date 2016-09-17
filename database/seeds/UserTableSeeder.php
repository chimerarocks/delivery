<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Delivery\Models\User::class, 10)->create()->each(function($u) {
        	$u->client()->save(factory(Delivery\Models\Client::class)->make());
        });
    }
}
