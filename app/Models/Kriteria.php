<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kriteria';

    protected $fillable = [
        'nama_kriteria',
        'jenis',
        // 'bobot'
    ];

    public function Perbandingan(){
        return $this->hasMany(Perbandingan::class,'id_kriteria_1','id_kriteria');
    }
}
