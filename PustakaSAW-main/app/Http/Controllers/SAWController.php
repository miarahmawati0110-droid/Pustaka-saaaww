<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\HasilSaw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SAWController extends Controller
{
    public function penilaian()
    {
        $anggotas = Anggota::orderBy('nama_anggota')->get();
        $kriterias = Kriteria::orderBy('kode_kriteria')->get();

        $nilaiTersimpan = Penilaian::all()
            ->keyBy(fn ($item) => $item->anggota_id . '-' . $item->kriteria_id);

        return view('penilaian.index', compact(
            'anggotas',
            'kriterias',
            'nilaiTersimpan'
        ));
    }

    public function simpanPenilaian(Request $request)
    {
        $data = $request->validate([
            'nilai' => 'required|array',
            'nilai.*' => 'required|array',
            'nilai.*.*' => 'required|numeric|min:0',
        ]);

        $anggotaIds = Anggota::pluck('id')->map(fn ($id) => (string) $id)->all();
        $kriteriaIds = Kriteria::pluck('id')->map(fn ($id) => (string) $id)->all();

        if (empty($anggotaIds) || empty($kriteriaIds)) {
            return back()->with('error', 'Tambahkan anggota dan kriteria terlebih dahulu.');
        }

        foreach ($data['nilai'] as $anggotaId => $nilaiPerKriteria) {
            if (!in_array((string) $anggotaId, $anggotaIds, true)) {
                return back()->with('error', 'Data anggota tidak valid.');
            }

            foreach ($nilaiPerKriteria as $kriteriaId => $nilai) {
                if (!in_array((string) $kriteriaId, $kriteriaIds, true)) {
                    return back()->with('error', 'Data kriteria tidak valid.');
                }
            }
        }

        DB::transaction(function () use ($data) {
            foreach ($data['nilai'] as $anggotaId => $nilaiPerKriteria) {
                foreach ($nilaiPerKriteria as $kriteriaId => $nilai) {
                    Penilaian::updateOrCreate(
                        [
                            'anggota_id' => $anggotaId,
                            'kriteria_id' => $kriteriaId,
                        ],
                        ['nilai' => $nilai]
                    );
                }
            }
        });

        return redirect()->route('penilaian.index')
            ->with('success', 'Data penilaian berhasil disimpan.');
    }

    public function hasil()
    {
        $hasilSaws = HasilSaw::with('anggota')
            ->orderBy('peringkat')
            ->get();

        $totalBobot = Kriteria::sum('bobot');

        return view('hasil-saw.index', compact('hasilSaws', 'totalBobot'));
    }

    public function hitung()
    {
        $anggotas = Anggota::orderBy('id')->get();
        $kriterias = Kriteria::orderBy('id')->get();

        if ($anggotas->isEmpty() || $kriterias->isEmpty()) {
            return redirect()->route('hasil-saw.index')
                ->with('error', 'Tambahkan anggota dan kriteria terlebih dahulu.');
        }

        $totalBobot = (float) $kriterias->sum('bobot');

        if (abs($totalBobot - 1) > 0.0001) {
            return redirect()->route('hasil-saw.index')
                ->with('error', 'Total bobot kriteria harus berjumlah 1,00. Total saat ini: ' .
                    number_format($totalBobot, 4, ',', '.'));
        }

        $penilaians = Penilaian::all()->keyBy(
            fn ($item) => $item->anggota_id . '-' . $item->kriteria_id
        );

        // Pastikan seluruh kombinasi anggota dan kriteria sudah dinilai.
        foreach ($anggotas as $anggota) {
            foreach ($kriterias as $kriteria) {
                if (!$penilaians->has($anggota->id . '-' . $kriteria->id)) {
                    return redirect()->route('penilaian.index')
                        ->with('error', 'Lengkapi semua nilai anggota untuk setiap kriteria sebelum menghitung SAW.');
                }
            }
        }

        $nilaiMatriks = [];

        foreach ($anggotas as $anggota) {
            foreach ($kriterias as $kriteria) {
                $nilaiMatriks[$anggota->id][$kriteria->id] =
                    (float) $penilaians[$anggota->id . '-' . $kriteria->id]->nilai;
            }
        }

        $maksimum = [];
        $minimum = [];

        foreach ($kriterias as $kriteria) {
            $kolom = [];

            foreach ($anggotas as $anggota) {
                $kolom[] = $nilaiMatriks[$anggota->id][$kriteria->id];
            }

            $maksimum[$kriteria->id] = max($kolom);
            $minimum[$kriteria->id] = min($kolom);
        }

        $hasil = [];

        foreach ($anggotas as $anggota) {
            $nilaiAkhir = 0;

            foreach ($kriterias as $kriteria) {
                $nilai = $nilaiMatriks[$anggota->id][$kriteria->id];

                if ($kriteria->jenis === 'benefit') {
                    $normalisasi = $maksimum[$kriteria->id] > 0
                        ? $nilai / $maksimum[$kriteria->id]
                        : 0;
                } else {
                    // Untuk cost, nilai positif terkecil menjadi yang terbaik.
                    if ($nilai <= 0) {
                        return redirect()->route('penilaian.index')
                            ->with('error', 'Nilai kriteria cost harus lebih besar dari 0 agar normalisasi dapat dihitung.');
                    }

                    $normalisasi = $minimum[$kriteria->id] / $nilai;
                }

                $nilaiAkhir += $normalisasi * (float) $kriteria->bobot;
            }

            $hasil[] = [
                'anggota_id' => $anggota->id,
                'nilai_akhir' => $nilaiAkhir,
            ];
        }

        // Urutkan dari nilai tertinggi ke terendah.
        usort($hasil, function ($a, $b) {
            return $b['nilai_akhir'] <=> $a['nilai_akhir'];
        });

        DB::transaction(function () use ($hasil) {
            HasilSaw::query()->delete();

            foreach ($hasil as $index => $item) {
                HasilSaw::create([
                    'anggota_id' => $item['anggota_id'],
                    'nilai_akhir' => $item['nilai_akhir'],
                    'peringkat' => $index + 1,
                ]);
            }
        });

        return redirect()->route('hasil-saw.index')
            ->with('success', 'Perhitungan SAW berhasil dilakukan.');
    }
}
