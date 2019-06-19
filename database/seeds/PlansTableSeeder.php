<?php

use DeskFlix\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Plan::class,1)->states(
            Plan::DURATION_MONTHLY
        )->create();
        factory(Plan::class,1)->states(
            Plan::DURATION_YEARLY
        )->create();
    }
}
