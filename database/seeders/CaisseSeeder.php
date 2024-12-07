<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CaisseSeeder extends Seeder
{
    public function run()
    {
        DB::table('caisses')->insert([
            [
                'date' => now()->subDays(1),
                'montant_initial' => 10000.00,
                'montant_recu' => 5000.00,
                'montant_depense' => 2000.00,
                'montant_total' => 13000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => now(),
                'montant_initial' => 13000.00,
                'montant_recu' => 7000.00,
                'montant_depense' => 4000.00,
                'montant_total' => 12000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
