<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['name' => "shoes",'description' => "Category contain sneakers ,heels,sandals and boots"]);
        DB::table('categories')->insert(['name' => "t-shirt",'description' => "many different t-shirts "]);
        DB::table('categories')->insert(['name' => "blouse",'description' => "many different blouses "]);
        DB::table('categories')->insert(['name' => "jacket",'description' => "many different jackets "]);
        DB::table('categories')->insert(['name' => "skirt",'description' => "many different skirts "]);
        DB::table('categories')->insert(['name' => "dress",'description' => "many different dresses "]);
        DB::table('categories')->insert(['name' => "pant",'description' => "many different pants "]);
        DB::table('categories')->insert(['name' => "sweatpants",'description' => "many different sweatpants "]);

    }
}
