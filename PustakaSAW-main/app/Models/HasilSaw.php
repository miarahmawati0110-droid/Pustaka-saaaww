<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSaw extends Model
{
    use HasFactory;

    protected $table = 'hasil_saws';

    protected $fillable = [
        'anggota_id',
        'nilai_akhir',
        'peringkat',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
