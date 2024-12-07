<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;


    protected $fillable = [
        'date_reception',
        'fournisseur_id',
        'categorie_id',
        'quantite',
        'reference',
        'responsable',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    public function categorie()
{
    return $this->belongsTo(Categorie::class);
}


    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->numero_reception)) {
                $model->numero_reception = 'REC-' . strtoupper(uniqid());
            }
        });
    }
}
