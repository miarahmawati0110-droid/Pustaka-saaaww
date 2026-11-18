<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenilaianSeeder extends Seeder
{
    public function run(): void
    {
        // Data simulasi penilaian anggota.
        // Urutan nilai: C1, C2, C3, C4, C5.
        $dataPenilaian = [
            'AG001' => [5, 5, 5, 5, 1], // Sarah Nasyifa
            'AG002' => [4, 4, 5, 4, 1], // Fajira Putri
            'AG003' => [5, 4, 4, 5, 2], // Muhammad Rizki
            'AG004' => [3, 3, 5, 4, 1], // Cut Aulia
            'AG005' => [4, 5, 3, 4, 3], // Ahmad Fauzan
            'AG006' => [3, 4, 5, 3, 1], // Nurul Husna
            'AG007' => [4, 3, 4, 4, 2], // Muhammad Ilham
            'AG008' => [2, 3, 5, 3, 1], // Nadia Safitri
            'AG009' => [5, 5, 4, 5, 2], // Andika Pratama
            'AG010' => [3, 4, 4, 3, 2], // Dewi Anggraini

            // Anggota lama yang masih tersimpan di database.
            '12345' => [3, 3, 4, 3, 2],
        ];

        $kodeKriteria = ['C1', 'C2', 'C3', 'C4', 'C5'];

        $jumlahTersimpan = 0;
        $anggotaTidakDitemukan = [];

        foreach ($dataPenilaian as $nomorAnggota => $nilaiKriteria) {
            $anggota = DB::table('anggotas')
                ->where('nomor_anggota', $nomorAnggota)
                ->first();

            if (!$anggota) {
                $anggotaTidakDitemukan[] = $nomorAnggota;
                continue;
            }

            foreach ($kodeKriteria as $index => $kode) {
                $kriteria = DB::table('kriterias')
                    ->where('kode_kriteria', $kode)
                    ->first();

                if (!$kriteria) {
                    throw new \RuntimeException(
                        "Kriteria {$kode} tidak ditemukan. Periksa Data Kriteria."
                    );
                }

                DB::table('penilaians')->updateOrInsert(
                    [
                        'anggota_id' => $anggota->id,
                        'kriteria_id' => $kriteria->id,
                    ],
                    [
                        'nilai' => $nilaiKriteria[$index],
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );

                $jumlahTersimpan++;
            }
        }

        $this->command->info(
            "Proses penilaian selesai. {$jumlahTersimpan} nilai berhasil disimpan atau diperbarui."
        );

        if (!empty($anggotaTidakDitemukan)) {
            $this->command->warn(
                'Nomor anggota yang tidak ditemukan: ' .
                implode(', ', $anggotaTidakDitemukan)
            );
        }
    }
}
