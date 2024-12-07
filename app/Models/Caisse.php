<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    use HasFactory;
    protected $table = 'caisse';

    protected $fillable = [
        'facture_id',
        'date_facture',
        'status',
        'client_id',
        'paiement',
    ];

    public function facture()
{
    return $this->belongsTo(Facture::class, 'facture_id');
}

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
