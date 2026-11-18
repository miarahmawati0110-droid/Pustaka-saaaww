<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        $daftarPeminjaman = [
            ['AG001', 'BK001', '2026-10-28', '2026-11-04', null, 'Dipinjam'],
            ['AG002', 'BK003', '2026-10-25', '2026-11-01', null, 'Dipinjam'],
            ['AG003', 'BK007', '2026-10-20', '2026-10-27', null, 'Dipinjam'],
            ['AG004', 'BK005', '2026-10-29', '2026-11-05', null, 'Dipinjam'],
            ['AG005', 'BK002', '2026-02-01', '2026-02-08', '2026-02-07', 'Dikembalikan'],
            ['AG006', 'BK004', '2026-02-10', '2026-02-17', '2026-02-16', 'Dikembalikan'],
            ['AG007', 'BK008', '2026-03-01', '2026-03-08', '2026-03-08', 'Dikembalikan'],
            ['AG008', 'BK006', '2026-03-10', '2026-03-17', '2026-03-15', 'Dikembalikan'],
            ['AG009', 'BK009', '2026-10-26', '2026-11-02', null, 'Dipinjam'],
            ['AG010', 'BK010', '2026-10-30', '2026-11-06', null, 'Dipinjam'],
        ];

        $berhasil = 0;
        $dilewati = 0;

        foreach ($daftarPeminjaman as $data) {
            [$nomorAnggota, $kodeBuku, $pinjam, $kembali, $dikembalikan, $status] = $data;

            $anggotaId = DB::table('anggotas')
                ->where('nomor_anggota', $nomorAnggota)
                ->value('id');

            $bukuId = DB::table('bukus')
                ->where('kode_buku', $kodeBuku)
                ->value('id');

            if (!$anggotaId || !$bukuId) {
                $dilewati++;
                continue;
            }

            $sekarang = Carbon::now();

            DB::table('peminjamen')->updateOrInsert(
                [
                    'anggota_id' => $anggotaId,
                    'buku_id' => $bukuId,
                ],
                [
                    'tanggal_pinjam' => $pinjam,
                    'tanggal_kembali' => $kembali,
                    'tanggal_dikembalikan' => $dikembalikan,
                    'status' => $status,
                    'created_at' => $sekarang,
                    'updated_at' => $sekarang,
                ]
            );

            $berhasil++;
        }

        $this->command->info(
            "Seeder selesai. Data diproses: {$berhasil}, dilewati karena buku/anggota tidak ditemukan: {$dilewati}."
        );
    }
}
