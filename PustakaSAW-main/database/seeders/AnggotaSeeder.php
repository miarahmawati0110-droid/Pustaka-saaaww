<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $daftarAnggota = [
            [
                'nomor_anggota' => 'AG001',
                'nama_anggota' => 'Sarah Nasyifa',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Pidie',
                'no_telepon' => '081234560001',
                'tanggal_daftar' => '2026-01-10',
            ],
            [
                'nomor_anggota' => 'AG002',
                'nama_anggota' => 'Fajira Putri',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Sigli',
                'no_telepon' => '081234560002',
                'tanggal_daftar' => '2026-01-12',
            ],
            [
                'nomor_anggota' => 'AG003',
                'nama_anggota' => 'Muhammad Rizki',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Beureunuen',
                'no_telepon' => '081234560003',
                'tanggal_daftar' => '2026-01-15',
            ],
            [
                'nomor_anggota' => 'AG004',
                'nama_anggota' => 'Cut Aulia',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Mutiara',
                'no_telepon' => '081234560004',
                'tanggal_daftar' => '2026-01-18',
            ],
            [
                'nomor_anggota' => 'AG005',
                'nama_anggota' => 'Ahmad Fauzan',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Pidie Jaya',
                'no_telepon' => '081234560005',
                'tanggal_daftar' => '2026-02-02',
            ],
            [
                'nomor_anggota' => 'AG006',
                'nama_anggota' => 'Nurul Husna',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Garoet',
                'no_telepon' => '081234560006',
                'tanggal_daftar' => '2026-02-05',
            ],
            [
                'nomor_anggota' => 'AG007',
                'nama_anggota' => 'Muhammad Ilham',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Tiro',
                'no_telepon' => '081234560007',
                'tanggal_daftar' => '2026-02-10',
            ],
            [
                'nomor_anggota' => 'AG008',
                'nama_anggota' => 'Nadia Safitri',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Tangse',
                'no_telepon' => '081234560008',
                'tanggal_daftar' => '2026-02-15',
            ],
            [
                'nomor_anggota' => 'AG009',
                'nama_anggota' => 'Andika Pratama',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Padang Tiji',
                'no_telepon' => '081234560009',
                'tanggal_daftar' => '2026-03-01',
            ],
            [
                'nomor_anggota' => 'AG010',
                'nama_anggota' => 'Dewi Anggraini',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Sakti',
                'no_telepon' => '081234560010',
                'tanggal_daftar' => '2026-03-05',
            ],
        ];

        foreach ($daftarAnggota as $data) {
            $sekarang = Carbon::now();

            DB::table('anggotas')->updateOrInsert(
                ['nomor_anggota' => $data['nomor_anggota']],
                array_merge($data, [
                    'created_at' => $sekarang,
                    'updated_at' => $sekarang,
                ])
            );
        }

        $this->command->info(
            '10 data anggota berhasil diperiksa dan ditambahkan.'
        );
    }
}
