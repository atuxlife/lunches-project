<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            "nombre"    => "Arroz con pollo"
        ]);
        Menu::create([
            "nombre"    => "Combo hamburguesa de carne"
        ]);
        Menu::create([
            "nombre"    => "Combo hamburguesa de pollo"
        ]);
        Menu::create([
            "nombre"    => "Arroz con carne"
        ]);
        Menu::create([
            "nombre"    => "Pollo con papas con salsa agridulce"
        ]);
        Menu::create([
            "nombre"    => "Estofado de carne con papas"
        ]);
    }
}
