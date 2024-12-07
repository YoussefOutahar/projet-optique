<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceptionSeeder extends Seeder
{
    public function run()
    {
        DB::table('receptions')->insert([
            [
                'numero_reception' => 'REC001',
                'date_reception' => now()->subDays(7),
                'fournisseur_id' => 1,
                'produit_id' => 1,
                'quantite_recue' => 50,
                'prix_achat' => 50.00,
                'total' => 2500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numero_reception' => 'REC002',
                'date_reception' => now()->subDays(3),
                'fournisseur_id' => 2,
                'produit_id' => 2,
                'quantite_recue' => 100,
                'prix_achat' => 30.00,
                'total' => 3000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
