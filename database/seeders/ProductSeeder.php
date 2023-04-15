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
        DB::table('products')->insert(['category_id' => 1,'name' => "black heels",'description' => "Lifestylesh Sandals Heeled Leather Corozy -black",'price'=>"209.99",'weight' => "1.5",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "gold heels",'description' => "Lifestylesh SN-507 Elegant Leather Heel Sandal - Gold",'price'=>"188.99",'weight' => "1.7",'shipping_rates_id'=>"2"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "green heels",'description' => "Fashion Women's High Heels Fashion Platform High Heel Sandals - Green",'price'=>"150.77",'weight' => "1.3",'shipping_rates_id'=>"1"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "white sneaker",'description' => "Desert Minimalist Lace-Up Knit Flat Sneakers - White",'price'=>"99.99",'weight' => "2.1",'shipping_rates_id'=>"2"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "black sneaker",'description' => "Desert Basic Lace-up Black Sneakers For Women",'price'=>"120.55",'weight' => "2.5",'shipping_rates_id'=>"1"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "color sneaker",'description' => "Fashion Shoes For Women Sneakers Summer Woman Casual Sport Shoe Flats Casual Ladies Mesh Breathable Shoes",'price'=>"300.77",'weight' => "3.1",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "black sandal",'description' => "Lifestylesh SN-509 Leather Sandal With An Elegant Open Strap - Black",'price'=>"100.77",'weight' => "2.1",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "white sandal",'description' => "Lifestylesh SN-505 Sandal Open Stylish Heel Leather - White",'price'=>"210.99",'weight' => "1.9",'shipping_rates_id'=>"2"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "brown sandal",'description' => "RUN Embossed Leather Flat Sandal-Brown",'price'=>"99.99",'weight' => "1.4",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "black long boot",'description' => "Fourteen Elegant Flat Long Boots For Women - Black",'price'=>"299.99",'weight' => "3.4",'shipping_rates_id'=>"1"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "white boot",'description' => "Woman Boot Heels Boots Above Ankle - White",'price'=>"250.99",'weight' => "3.0",'shipping_rates_id'=>"2"]);
        DB::table('products')->insert(['category_id' => 1,'name' => "camel boot",'description' => "Dejavu Double Closure Mid Calf Camel Safety Boots",'price'=>"240.99",'weight' => "3.3",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 2,'name' => "print t-shirt",'description' => "Coool Star Wars Oversize Fit Back Printed Short Sleeve T-Shirt",'price'=>"70.99",'weight' => "0.2",'shipping_rates_id'=>"1"]);
        DB::table('products')->insert(['category_id' => 2,'name' => "crop top t-shirt",'description' => "Crop Top NFL Shield Licensed Crew Neck Thick Sweatshirt Fabric Short Sleeve T-Shirt",'price'=>"100.99",'weight' => "0.8",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 2,'name' => "miam t-shirt",'description' => "Defacto Fit NBA Miami Heat Standard Fit Crew Neck Short Sleeve T-Shirt",'price'=>"100.99",'weight' => "0.8",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 3,'name' => "American blouse",'description' => "American Eagle AE Oversized Square Neck Long-Sleeve Peasant Blouse",'price'=>"60.99",'weight' => "0.3",'shipping_rates_id'=>"2"]);
        DB::table('products')->insert(['category_id' => 3,'name' => "blue blouse",'description' => "American Eagle AE Oversized Square Neck Long-Sleeve Peasant Blouse",'price'=>"90.99",'weight' => "0.6",'shipping_rates_id'=>"1"]);
        DB::table('products')->insert(['category_id' => 3,'name' => "soft pink blouse",'description' => "Sun Set Blouse For Women _ Soft _ PINK",'price'=>"100.0",'weight' => "0.9",'shipping_rates_id'=>"2"]);
        DB::table('products')->insert(['category_id' => 4,'name' => "pink jacket",'description' => "Andora Plain Rose Buttons Closure Long Sleeves Gabardine Jacket",'price'=>"105.99",'weight' => "2.9",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 4,'name' => "black jacket",'description' => "Andora Comfy Solid Front Zipper Jacket - Black",'price'=>"90.99",'weight' => "4.1",'shipping_rates_id'=>"1"]);
        DB::table('products')->insert(['category_id' => 4,'name' => "green jacket",'description' => "Fashion Solid Dual Pocket Open Front Teddy Coat-Green",'price'=>"100.0",'weight' => "4.9",'shipping_rates_id'=>"2"]);
        DB::table('products')->insert(['category_id' => 5,'name' => "yellow long skirt",'description' => "Menta By Coctail Dark Blue Tie Dye With Wide Elastic Waist Maxi Skirt",'price'=>"60.99",'weight' => "1.5",'shipping_rates_id'=>"1"]);
        DB::table('products')->insert(['category_id' => 5,'name' => "blue long skirt",'description' => "Menta By Coctail Dark Blue Tie Dye With Wide Elastic Waist Maxi Skirt",'price'=>"50.99",'weight' => "1.1",'shipping_rates_id'=>"1"]);
        DB::table('products')->insert(['category_id' => 5,'name' => "black short skirt",'description' => "Lining Shorts High Waisted Goth Skirt White Black Black S",'price'=>"120.0",'weight' => "2.7",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 6,'name' => "color dress",'description' => "Menta By Coctail Fulla Dress With A Hole In The Tail-pink",'price'=>"60.99",'weight' => "1.5",'shipping_rates_id'=>"1"]);
        DB::table('products')->insert(['category_id' => 6,'name' => "blue dress",'description' => "Menta By Coctail Floral Dress - Blue Sky",'price'=>"300.99",'weight' => "3.1",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 6,'name' => "pink dress",'description' => "Kady Slip On Plain Elastic Waist Cotton Dress - Dark Pink",'price'=>"190.0",'weight' => "2.7",'shipping_rates_id'=>"1"]);
        DB::table('products')->insert(['category_id' => 7,'name' => "black pants",'description' => "Wide Leg Trousers",'price'=>"40.99",'weight' => "1.5",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 7,'name' => "green dress",'description' => "Fashion Low Rise Casual Pants For Women All-Match Trousers With",'price'=>"30.99",'weight' => "2.2",'shipping_rates_id'=>"1"]);
        DB::table('products')->insert(['category_id' => 7,'name' => "pink pants",'description' => "Wowen Fabrics Trousers",'price'=>"90.0",'weight' => "1.7",'shipping_rates_id'=>"2"]);
        DB::table('products')->insert(['category_id' => 8,'name' => "black sweatpants",'description' => "Fashion Low Rise Casual Pants For Women All-Match Trousers With",'price'=>"105.55",'weight' => "1.7",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 8,'name' => "grey sweatpants",'description' => "Air Walk Sports Sweatpants With Inner Fleece Material - Dark Grey",'price'=>"100.99",'weight' => "1.1",'shipping_rates_id'=>"3"]);
        DB::table('products')->insert(['category_id' => 8,'name' => "orange sweatpants",'description' => "aZeeZ Orange Marbel Winter Sweatpant -Women",'price'=>"190.0",'weight' => "2.3",'shipping_rates_id'=>"2"]);
    }
}
