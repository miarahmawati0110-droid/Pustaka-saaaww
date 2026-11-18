<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'anggota_id',
        'kriteria_id',
        'nilai',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
