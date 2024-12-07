<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'vision',
        'od_sphere',
        'od_cylinder',
        'od_axis',
        'od_add',
        'od_epi',
        'os_sphere',
        'os_cylinder',
        'os_axis',
        'os_add',
        'os_epi',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
