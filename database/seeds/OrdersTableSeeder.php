<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = app(\DeskFlix\Repositories\UserRepository::class)->all();
        $orders = factory(\DeskFlix\Models\Order::class,30)->make();
        /*$order = $orders->first();
        $order->user_id = 1;
        $order->save();*/
        $orders->each(function($order)use($users){
            $order->user_id = $users->random()->id;
            $order->save();
        });
    }
}
