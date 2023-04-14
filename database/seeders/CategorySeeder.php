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
        DB::table('categories')->insert(['name' => "Clothes Category",'description' => "Category contain t-shirts ,blouse,pants ,sweatpants and jackets"]);
        DB::table('categories')->insert(['name' => "Shoes Category",'description' => "Category contain sneakers ,heels,sandals and boots"]);

    }
}
