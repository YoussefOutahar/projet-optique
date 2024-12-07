<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VenteSeeder extends Seeder
{
    public function run()
    {
        DB::table('ventes')->insert([
            [
                'numero_facture' => 'FACT001',
                'date_facture' => now()->subDays(10),
                'client_id' => 1,
                'status' => 'Réglé',
                'total' => 500.00,
                'remise' => 50.00,
                'avance' => 200.00,
                'reste_a_payer' => 250.00,
                'responsable' => 'Responsable A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'numero_facture' => 'FACT002',
                'date_facture' => now()->subDays(5),
                'client_id' => 2,
                'status' => 'Non Réglé',
                'total' => 800.00,
                'remise' => 100.00,
                'avance' => 300.00,
                'reste_a_payer' => 400.00,
                'responsable' => 'Responsable B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
