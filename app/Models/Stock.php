<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'produit_id',
        'stock_min',
        'stock_max',
        'stock_reel',
        'prix_vente',
    ];
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
 