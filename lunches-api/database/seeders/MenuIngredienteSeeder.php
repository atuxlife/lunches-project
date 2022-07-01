<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuIngrediente;

class MenuIngredienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ingredientes plato Arroz con pollo
        MenuIngrediente::create([
            "menu_id"           => 1,
            "ingrediente_id"    => 4
        ]);
        MenuIngrediente::create([
            "menu_id"           => 1,
            "ingrediente_id"    => 1
        ]);
        MenuIngrediente::create([
            "menu_id"           => 1,
            "ingrediente_id"    => 7
        ]);
        MenuIngrediente::create([
            "menu_id"           => 1,
            "ingrediente_id"    => 10
        ]);
        // Ingredientes plato Combo hamburguesa de carne
        MenuIngrediente::create([
            "menu_id"           => 2,
            "ingrediente_id"    => 1
        ]);
        MenuIngrediente::create([
            "menu_id"           => 2,
            "ingrediente_id"    => 3
        ]);
        MenuIngrediente::create([
            "menu_id"           => 2,
            "ingrediente_id"    => 5
        ]);
        MenuIngrediente::create([
            "menu_id"           => 2,
            "ingrediente_id"    => 6
        ]);
        MenuIngrediente::create([
            "menu_id"           => 2,
            "ingrediente_id"    => 7
        ]);
        MenuIngrediente::create([
            "menu_id"           => 2,
            "ingrediente_id"    => 8
        ]);
        MenuIngrediente::create([
            "menu_id"           => 2,
            "ingrediente_id"    => 9
        ]);
        // Ingredientes plato Combo hamburguesa de pollo
        MenuIngrediente::create([
            "menu_id"           => 3,
            "ingrediente_id"    => 1
        ]);
        MenuIngrediente::create([
            "menu_id"           => 3,
            "ingrediente_id"    => 3
        ]);
        MenuIngrediente::create([
            "menu_id"           => 3,
            "ingrediente_id"    => 5
        ]);
        MenuIngrediente::create([
            "menu_id"           => 3,
            "ingrediente_id"    => 6
        ]);
        MenuIngrediente::create([
            "menu_id"           => 3,
            "ingrediente_id"    => 7
        ]);
        MenuIngrediente::create([
            "menu_id"           => 3,
            "ingrediente_id"    => 8
        ]);
        MenuIngrediente::create([
            "menu_id"           => 3,
            "ingrediente_id"    => 10
        ]);
        // Ingredientes plato Arroz con carne
        MenuIngrediente::create([
            "menu_id"           => 4,
            "ingrediente_id"    => 4
        ]);
        MenuIngrediente::create([
            "menu_id"           => 4,
            "ingrediente_id"    => 1
        ]);
        MenuIngrediente::create([
            "menu_id"           => 4,
            "ingrediente_id"    => 7
        ]);
        MenuIngrediente::create([
            "menu_id"           => 4,
            "ingrediente_id"    => 9
        ]);
        // Ingredientes plato Pollo con papas con salsa agridulce
        MenuIngrediente::create([
            "menu_id"           => 5,
            "ingrediente_id"    => 2
        ]);
        MenuIngrediente::create([
            "menu_id"           => 5,
            "ingrediente_id"    => 3
        ]);
        MenuIngrediente::create([
            "menu_id"           => 5,
            "ingrediente_id"    => 5
        ]);
        MenuIngrediente::create([
            "menu_id"           => 5,
            "ingrediente_id"    => 7
        ]);
        MenuIngrediente::create([
            "menu_id"           => 5,
            "ingrediente_id"    => 10
        ]);
        // Ingredientes plato Estofado de carne con papas
        MenuIngrediente::create([
            "menu_id"           => 6,
            "ingrediente_id"    => 1
        ]);
        MenuIngrediente::create([
            "menu_id"           => 6,
            "ingrediente_id"    => 3
        ]);
        MenuIngrediente::create([
            "menu_id"           => 6,
            "ingrediente_id"    => 5
        ]);
        MenuIngrediente::create([
            "menu_id"           => 6,
            "ingrediente_id"    => 7
        ]);
        MenuIngrediente::create([
            "menu_id"           => 6,
            "ingrediente_id"    => 9
        ]);
    }
}
