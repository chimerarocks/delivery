<?php

use Delivery\Models\User;
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
        factory(User::class, 10)->create()->each(function($u) {
        	$u->client()->save(factory(\Delivery\Models\Client::class)->make());
        });

        factory(User::class)->create([
            'email' => 'user@user.com'
        ])->client()->save(factory(\Delivery\Models\Client::class)->make());
        
        factory(User::class)->create([
            'email' => 'admin@user.com', 
            'role' => 'admin'
        ])->client()->save(factory(\Delivery\Models\Client::class)->make());;
        
        factory(User::class)->create([
            'email' => 'deliveryman@user.com', 
            'role' => 'deliveryman'
        ]);
    }
}
