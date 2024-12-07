<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    public function run()
    {
        DB::table('stocks')->insert([
            [
                'produit_id' => 1,
                'stock_min' => 10,
                'stock_max' => 200,
                'stock_reel' => 100,
                'prix_vente' => 70.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'produit_id' => 2,
                'stock_min' => 5,
                'stock_max' => 150,
                'stock_reel' => 200,
                'prix_vente' => 45.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
