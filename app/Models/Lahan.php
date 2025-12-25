<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
{
    protected $table = 'lahan';
    
    protected $fillable = [
        'peserta_id',
        'petani_id',
        'no_shm',
        'tanggal_shm',
        'alamat_jaminan',
        'luas_jumlah',
        'blok_id',
    ];

    protected $casts = [
        'tanggal_shm' => 'date',
        'luas_jumlah' => 'integer',
    ];

    public function peserta()
    {
        return $this->belongsTo(PesertaPlasma::class, 'peserta_id');
    }

    public function petani()
    {
        return $this->belongsTo(Petani::class, 'petani_id');
    }

    public function blok()
    {
        return $this->belongsTo(Blok::class, 'blok_id');
    }
}
