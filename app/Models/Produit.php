<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'marque',
        'categorie_id',  
        'fournisseur_id',
        'quantite_stock',
        'prix_achat',
        'prix_vente',
        'vente_id' 
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function ventes()
{
    return $this->belongsToMany(Vente::class, 'vente_produit')
                ->withPivot('quantite', 'categorie_id')
                ->withTimestamps();
}

    public function factures()
    {
        return $this->belongsToMany(Facture::class, 'facture_produit')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }
}
