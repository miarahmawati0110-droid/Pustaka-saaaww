<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Kriteria;
use App\Models\HasilSaw;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalAnggota = Anggota::count();
        $totalPeminjaman = Peminjaman::count();

        $peminjamanAktif = Peminjaman::where(
            'status',
            'Dipinjam'
        )->count();

        $totalKriteria = Kriteria::count();
        $totalHasilSAW = HasilSaw::count();

        $peminjamanTerbaru = Peminjaman::with([
            'buku',
            'anggota'
        ])->latest()->take(5)->get();

        $peringkatSAW = HasilSaw::with('anggota')
            ->orderBy('peringkat')
            ->take(5)
            ->get();

        // Data grafik peminjaman enam bulan terakhir
        $labelGrafik = [];
        $dataGrafik = [];

        for ($i = 5; $i >= 0; $i--) {
            $tanggal = Carbon::now()->startOfMonth()->subMonths($i);

            $labelGrafik[] = $tanggal->translatedFormat('M Y');

            $dataGrafik[] = Peminjaman::whereYear(
                'created_at',
                $tanggal->year
            )->whereMonth(
                'created_at',
                $tanggal->month
            )->count();
        }

        return view('dashboard', compact(
            'totalBuku',
            'totalAnggota',
            'totalPeminjaman',
            'peminjamanAktif',
            'totalKriteria',
            'totalHasilSAW',
            'peminjamanTerbaru',
            'peringkatSAW',
            'labelGrafik',
            'dataGrafik'
        ));
    }
}
