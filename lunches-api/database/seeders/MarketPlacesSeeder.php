<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MarketPlace;

class MarketPlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarketPlace::create([
            "nombre"    => "tomato",
            "stock"     => 10
        ]);
        MarketPlace::create([
            "nombre"    => "lemon",
            "stock"     => 10
        ]);
        MarketPlace::create([
            "nombre"    => "potato",
            "stock"     => 10
        ]);
        MarketPlace::create([
            "nombre"    => "rice",
            "stock"     => 10
        ]);
        MarketPlace::create([
            "nombre"    => "ketchup",
            "stock"     => 10
        ]);
        MarketPlace::create([
            "nombre"    => "lettuce",
            "stock"     => 10
        ]);
        MarketPlace::create([
            "nombre"    => "onion",
            "stock"     => 10
        ]);
        MarketPlace::create([
            "nombre"    => "cheese",
            "stock"     => 10
        ]);
        MarketPlace::create([
            "nombre"    => "meat",
            "stock"     => 10
        ]);
        MarketPlace::create([
            "nombre"    => "chicken",
            "stock"     => 10
        ]);
    }
}
