<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_rates')->insert(['country' => "US",'rate'=>"2"]);
        DB::table('shipping_rates')->insert(['country' => "UK",'rate'=>"3"]);
        DB::table('shipping_rates')->insert(['country' => "CN",'rate'=>"2"]);


    }
}
