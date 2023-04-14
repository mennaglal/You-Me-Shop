<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(['category_id' => 1,'name' => "t-shirt",'description' => "Pinky T-Shirt",'price'=>"30.99",'weight' => "0.2",'shipping_rates_id'=>"1"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "Blouse",'description' => "Blue Blouse",'price'=>"10.99",'weight' => "0.3",'shipping_rates_id'=>"2"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "pants",'description' => "Black Pants",'price'=>"64.99",'weight' => "0.9",'shipping_rates_id'=>"2"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "sweatpants",'description' => "Orange SweatPants",'price'=>"84.99",'weight' => "1.1",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "jacket",'description' => "Black Jacket",'price'=>"199.99",'weight' => "2.2",'shipping_rates_id'=>"1"]);
        DB::table('products')->insert(['category_id' => 2,'name' => "shoes",'description' => "Black Shoes",'price'=>"79.99",'weight' => "1.3",'shipping_rates_id'=>"3"]);
    }
}
