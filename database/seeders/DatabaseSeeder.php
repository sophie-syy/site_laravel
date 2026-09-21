<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parcel;
use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Parcel::create([
            'nom' => 'Admin',
            'prenom' => 'Admin',
            'email' => 'admin@linstantthe.fr',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        $nomsCategories = [
            'Bubble Tea',
            'Jus',
            'Thé',
            'Glace',
        ];

        foreach ($nomsCategories as $nom) {
            Categorie::create([
                'nom' => $nom,
            ]);
        }

        $categories = Categorie::all();

        Produit::factory()
            ->count(20)
            ->create()
            ->each(function ($produit) use ($categories) {

                $produit->categories()->attach(
                    $categories->random(rand(1, 2))
                );
            });
    }
}
