<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EyeDetail;


class Client extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nom', 'prenom', 'telephone', 'genre', 'cine', 'adresse', 'premiere_visite', 'derniere_visite', 'typeassurance', 'beneficiary',
    'vision', 'od_sphere', 'od_cylinder', 'od_axis', 'od_add', 'od_epi',
    'os_sphere', 'os_cylinder', 'os_axis', 'os_add', 'os_epi', 'nombre_visite',
    ];
    public function eyeDetail()
    {
        return $this->hasOne(EyeDetail::class);
    }
    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }
     public function factures()
     {
         return $this->hasMany(Facture::class, 'client_id');
     }
 
     public function caisses()
     {
         return $this->hasMany(Caisse::class, 'client_id');
     }
}
