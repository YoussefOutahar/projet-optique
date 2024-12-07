<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_facture',
        'date_facture',
        'client_id',
        'status',
        'vente_id',
        'total',
        'remise',
        'avance',
        'reste_a_payer',
        'responsable', 
    ];

    public function caisses()
    {
        return $this->hasMany(Caisse::class, 'facture_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function produits()
{
    return $this->belongsToMany(Produit::class, 'facture_produit')
                ->withPivot('quantite') 
                ->withTimestamps();
}
public function vente()
{
    return $this->belongsTo(Vente::class);
}

}
