<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'numero_vente',
        'date_facture',
        'client_id',
        'status',
        'total',
        'remise',
        'avance',
        'reste_a_payer',
        'responsable',
    ];
protected $casts = [
    'date_facture' => 'datetime:Y-m-d',
];
    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
 
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($vente) {
            $vente->numero_vente = self::generateNumeroFacture();
        });
    }

    public static function generateNumeroFacture()
    {
        $latestVente = self::latest()->first();

        $nextId = $latestVente ? ($latestVente->id + 1) : 1;
        $year = date('Y');
        $numeroFacture = sprintf('Digi-%02d-%d', $nextId, $year);

        return $numeroFacture;
    }
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'vente_produit')
                    ->withPivot('quantite', 'categorie_id')
                    ->withTimestamps();
    }
    }
