<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $table = 'simpanan';
    
    protected $fillable = [
        'peserta_id',
        'jenis',
        'nominal',
        'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'integer'
    ];

    public function peserta()
    {
        return $this->belongsTo(PesertaPlasma::class, 'peserta_id');
    }
}
