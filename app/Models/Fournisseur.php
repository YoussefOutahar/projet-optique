<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fournisseur extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'societe',
        'responsable',
        'adresse',
        'ville',
        'telephone',
        'mobile',
        'email',
        'ice',
        'observation',
    ];
}
