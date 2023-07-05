<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_sk';

    protected $fillable = [
        'nama_sk',
        'id_kriteria',
        'nilai'
    ];
}
