<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaPlasma extends Model
{
    protected $table = 'peserta_plasma';
    protected $fillable = [
        'no_reg',
        'nama',
        'nik_ktp',
        'no_kk',
        'alamat',
        'no_hp',
        'photo',
        'kelompok_id',
    ];
}
