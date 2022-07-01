<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingrediente;

class IngredienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingrediente::create([
            "nombre"    => "tomato",
            "stock"     => 5
        ]);
        Ingrediente::create([
            "nombre"    => "lemon",
            "stock"     => 5
        ]);
        Ingrediente::create([
            "nombre"    => "potato",
            "stock"     => 5
        ]);
        Ingrediente::create([
            "nombre"    => "rice",
            "stock"     => 5
        ]);
        Ingrediente::create([
            "nombre"    => "ketchup",
            "stock"     => 5
        ]);
        Ingrediente::create([
            "nombre"    => "lettuce",
            "stock"     => 5
        ]);
        Ingrediente::create([
            "nombre"    => "onion",
            "stock"     => 5
        ]);
        Ingrediente::create([
            "nombre"    => "cheese",
            "stock"     => 5
        ]);
        Ingrediente::create([
            "nombre"    => "meat",
            "stock"     => 5
        ]);
        Ingrediente::create([
            "nombre"    => "chicken",
            "stock"     => 5
        ]);
    }
}
