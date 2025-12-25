<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blok extends Model
{
    protected $table = 'blok';
    
    protected $fillable = [
        'kode_blok',
        'kelompok_id',
    ];

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }
}
