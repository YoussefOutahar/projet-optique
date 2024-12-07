<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\Fournisseur;

class ProduitSeeder extends Seeder
{
    public function run()
    {
        // Récupérer les fournisseurs pour les utiliser comme clés étrangères
        $fournisseur1 = Fournisseur::where('societe', 'Fournisseur 1')->first();
        $fournisseur2 = Fournisseur::where('societe', 'Fournisseur 2')->first();

        Produit::create([
            'reference' => 'REF001',
            'designation' => 'Produit A',
            'categorie' => 'Catégorie 1',
            'fournisseur_id' => $fournisseur1->id,
            'quantite_stock' => 100,
            'prix_achat' => 50.00,
            'prix_vente' => 75.00,
        ]);

        Produit::create([
            'reference' => 'REF002',
            'designation' => 'Produit B',
            'categorie' => 'Catégorie 2',
            'fournisseur_id' => $fournisseur2->id,
            'quantite_stock' => 200,
            'prix_achat' => 30.00,
            'prix_vente' => 45.00,
        ]);

        // Ajoutez d'autres produits si nécessaire
    }
}
