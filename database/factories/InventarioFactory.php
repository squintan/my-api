<?php

namespace Database\Factories;

use App\Models\Inventario;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventarioFactory extends Factory
{
    protected $model = Inventario::class;

    public function definition()
    {
        return [
            'producto_id' => $this->faker->numberBetween(1, 100), // ID del producto
            'nombre' => $this->faker->word, // Nombre del producto
            'cantidad' => $this->faker->numberBetween(1, 500), // Cantidad disponible
            'precio' => $this->faker->randomFloat(2, 1, 1000), // Precio del producto
            'ubicacion' => $this->faker->sentence, // Ubicación en la tienda
        ];
    }
}
