<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    public function run()
    {
        DB::table('clients')->insert([
            [
                'nom' => 'Client A',
                'prenom' => 'Prénom A',
                'telephone' => '0123456789',
                'genre' => 'M',
                'cine' => 'CIN123456',
                'adresse' => 'Adresse A',
                'premiere_visite' => now()->subYear(),
                'derniere_visite' => now(),
                'client_depuis' => now()->subYears(2),
                'total_vente' => 1000.00,
                'total_reglement' => 500.00,
                'reste_du' => 500.00,
                'nombre_visite' => 5,
                'assurance' => 'Assurance A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Client B',
                'prenom' => 'Prénom B',
                'telephone' => '0987654321',
                'genre' => 'F',
                'cine' => 'CIN654321',
                'adresse' => 'Adresse B',
                'premiere_visite' => now()->subMonths(6),
                'derniere_visite' => now(),
                'client_depuis' => now()->subMonths(6),
                'total_vente' => 1500.00,
                'total_reglement' => 1000.00,
                'reste_du' => 500.00,
                'nombre_visite' => 3,
                'assurance' => 'Assurance B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
