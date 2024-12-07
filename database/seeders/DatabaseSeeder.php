<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            FournisseurSeeder::class,
            ProduitSeeder::class,
            // Ajoutez d'autres seeders si nécessaire
        ]);
    }
}
