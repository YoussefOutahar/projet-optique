<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fournisseur;

class FournisseurSeeder extends Seeder
{
    public function run()
    {
        Fournisseur::create([
            'societe' => 'Fournisseur 1',
            'responsable' => 'Responsable 1',
            'adresse' => '123 Rue Exemple',
            'ville' => 'Ville 1',
            'telephone' => '0123456789',
            'mobile' => '0612345678',
            'email' => 'contact@fournisseur1.com',
            'ice' => '123456789',
            'observation' => 'Observation 1',
        ]);

        Fournisseur::create([
            'societe' => 'Fournisseur 2',
            'responsable' => 'Responsable 2',
            'adresse' => '456 Rue Exemple',
            'ville' => 'Ville 2',
            'telephone' => '0987654321',
            'mobile' => '0698765432',
            'email' => 'contact@fournisseur2.com',
            'ice' => '987654321',
            'observation' => 'Observation 2',
        ]);

        // Ajoutez d'autres fournisseurs si nécessaire
    }
}
