<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $daftarKriteria = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Frekuensi Peminjaman',
                'jenis' => 'benefit',
                'bobot' => 0.30,
                'keterangan' => 'Jumlah transaksi peminjaman yang dilakukan anggota.',
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Jumlah Buku Dipinjam',
                'jenis' => 'benefit',
                'bobot' => 0.25,
                'keterangan' => 'Jumlah buku yang dipinjam anggota.',
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Ketepatan Pengembalian',
                'jenis' => 'benefit',
                'bobot' => 0.20,
                'keterangan' => 'Tingkat ketepatan anggota dalam mengembalikan buku.',
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Keaktifan Anggota',
                'jenis' => 'benefit',
                'bobot' => 0.15,
                'keterangan' => 'Tingkat keaktifan anggota menggunakan layanan perpustakaan.',
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_kriteria' => 'Denda Keterlambatan',
                'jenis' => 'cost',
                'bobot' => 0.10,
                'keterangan' => 'Jumlah denda keterlambatan; semakin kecil semakin baik.',
            ],
        ];

        $sekarang = Carbon::now();

        foreach ($daftarKriteria as $data) {
            DB::table('kriterias')->updateOrInsert(
                ['kode_kriteria' => $data['kode_kriteria']],
                array_merge($data, [
                    'updated_at' => $sekarang,
                    'created_at' => $sekarang,
                ])
            );
        }

        $this->command->info(
            '5 kriteria SAW berhasil diperiksa dan ditambahkan.'
        );
    }
}
