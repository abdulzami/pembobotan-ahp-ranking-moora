<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bobot extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_bobot';

    protected $fillable = [
        'id_kriteria',
        'nilai',
    ];

    function Kriteria(){
        return $this->belongsTo(Kriteria::class,'id_kriteria','id_kriteria');
    }
}
