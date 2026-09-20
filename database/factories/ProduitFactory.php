<?php

namespace Database\Factories;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitFactory extends Factory
{
    protected $model = Produit::class;

    public function definition(): array
    {
        return [
            'nom' => fake()->randomElement([
                'Mango Tea',
                'Strawberry Tea',
                'Peach Tea',
                'Matcha Bubble Tea',
                'Taro Milk Tea',
                'Passion Tea',
                'Jus d\'orange',
                'Jus de pomme',
                'Jus d\'ananas',
            ]),

            'description' => fake()->sentence(),

            'prix' => fake()->randomFloat(2, 3, 8),

            'image' => fake()->randomElement([
                '1.jpg',
                '2.jpg',
                '3.jpg',
                '4.jpg',
                '5.jpg',
                '6.jpg',
                '7.jpg',
                '8.jpg',
                '9.jpg',
            ]),
        ];
    }
}

