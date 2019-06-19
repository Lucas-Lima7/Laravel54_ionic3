<?php

use Deskflix\Repositories\OrderRepository;
use Deskflix\Repositories\PlanRepository;
use Deskflix\Repositories\SubscriptionRepository;
use Illuminate\Database\Seeder;

class SubscriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = app(PlanRepository::class)->all();
        $orders = app(OrderRepository::class)->all();
        /*$subscriptions= factory(Subscription::class, 20)->make();
        $subscriptions->each(function ($subscription) use($plans, $orders){
           $subscription->plan_id = $plans->random()->id;
           $subscription->order_id = $orders->random()->id;
           $subscription->expires_at = '2017-07-17';
           $subscription->save();
        });*/

        $repository = app(SubscriptionRepository::class);
        //foreach (range(1, $orders->count()) as $key => $element) {
        foreach (range(1,20) as $element) {
            $repository->create([
                'plan_id' => $plans->random()->id,
                //'order_id' => $orders[$key]->id,
                'order_id' => $orders->random()->id,
            ]);
        }
    }
}
