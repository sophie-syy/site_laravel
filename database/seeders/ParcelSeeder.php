<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Parcel;
use Illuminate\Support\Facades\Hash;

class ParcelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    Parcel::create([
        'nom' => 'Admin',
        'prenom' => 'Administrateur',
        'email' => 'admin@linstantthe.fr',
        'password' => Hash::make('admin123'),
        'role' => 'admin',
    ]);
    }
}


