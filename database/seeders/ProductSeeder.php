<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
            'name' => "Veggie Melt Sandwich",
            'tag' => "veggie_melt",
            'coupon' => "VM77FREE",
            ],
            [
            'name' => "Pesto Chicken Sandwich",
            'tag' => "pesto_chicken",
            'coupon' => "PPDE1FREE",
            ],
            [
            'name' => "Chicken Tikka Baguette",
            'tag' => "chicken_tikka",
            'coupon' => "CT14FREE",
            ],
            [
            'name' => "Spicy Meatball Sandwich",
            'tag' => "spicy_meatball",
            'coupon' => "SM98FREE",
            ]
        ]);
    }
}
