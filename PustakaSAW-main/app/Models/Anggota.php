<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_anggota',
        'nama_anggota',
        'jenis_kelamin',
        'alamat',
        'no_telepon',
        'tanggal_daftar',
    ];
}
