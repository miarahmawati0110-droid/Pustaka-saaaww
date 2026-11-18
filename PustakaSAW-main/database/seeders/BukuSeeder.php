<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $daftarBuku = [
            [
                'kode_buku' => 'BK001',
                'judul_buku' => 'Laskar Pelangi',
                'pengarang' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'kategori' => 'Novel',
                'stok' => 8,
            ],
            [
                'kode_buku' => 'BK002',
                'judul_buku' => 'Bumi Manusia',
                'pengarang' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Lentera Dipantara',
                'tahun_terbit' => 1980,
                'kategori' => 'Novel',
                'stok' => 5,
            ],
            [
                'kode_buku' => 'BK003',
                'judul_buku' => 'Negeri 5 Menara',
                'pengarang' => 'Ahmad Fuadi',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2009,
                'kategori' => 'Novel',
                'stok' => 7,
            ],
            [
                'kode_buku' => 'BK004',
                'judul_buku' => 'Atomic Habits',
                'pengarang' => 'James Clear',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2019,
                'kategori' => 'Pengembangan Diri',
                'stok' => 6,
            ],
            [
                'kode_buku' => 'BK005',
                'judul_buku' => 'Filosofi Teras',
                'pengarang' => 'Henry Manampiring',
                'penerbit' => 'Kompas',
                'tahun_terbit' => 2018,
                'kategori' => 'Filsafat',
                'stok' => 4,
            ],
            [
                'kode_buku' => 'BK006',
                'judul_buku' => 'Matematika Dasar',
                'pengarang' => 'Soedjadi',
                'penerbit' => 'Universitas Terbuka',
                'tahun_terbit' => 2014,
                'kategori' => 'Pendidikan',
                'stok' => 10,
            ],
            [
                'kode_buku' => 'BK007',
                'judul_buku' => 'Dasar-Dasar Pemrograman',
                'pengarang' => 'Abdul Kadir',
                'penerbit' => 'Andi',
                'tahun_terbit' => 2017,
                'kategori' => 'Teknologi',
                'stok' => 5,
            ],
            [
                'kode_buku' => 'BK008',
                'judul_buku' => 'Belajar Python',
                'pengarang' => 'Budi Raharjo',
                'penerbit' => 'Informatika',
                'tahun_terbit' => 2021,
                'kategori' => 'Teknologi',
                'stok' => 6,
            ],
            [
                'kode_buku' => 'BK009',
                'judul_buku' => 'Sejarah Indonesia',
                'pengarang' => 'R. Soekmono',
                'penerbit' => 'Kanisius',
                'tahun_terbit' => 2015,
                'kategori' => 'Sejarah',
                'stok' => 4,
            ],
            [
                'kode_buku' => 'BK010',
                'judul_buku' => 'Bahasa Indonesia untuk Perguruan Tinggi',
                'pengarang' => 'Dalman',
                'penerbit' => 'Rajawali Pers',
                'tahun_terbit' => 2016,
                'kategori' => 'Pendidikan',
                'stok' => 8,
            ],
        ];

        foreach ($daftarBuku as $data) {
            Buku::firstOrCreate(
                ['kode_buku' => $data['kode_buku']],
                $data
            );
        }

        $this->command->info('Data buku contoh berhasil diperiksa dan ditambahkan.');
    }
}
