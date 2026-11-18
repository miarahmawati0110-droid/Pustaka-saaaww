<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['buku', 'anggota'])
            ->latest()
            ->get();

        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $bukus = Buku::where('stok', '>', 0)->orderBy('judul_buku')->get();
        $anggotas = Anggota::orderBy('nama_anggota')->get();

        return view('peminjaman.create', compact('bukus', 'anggotas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
        ]);

        if (Anggota::doesntExist()) {
            return back()->withInput()
                ->withErrors(['anggota_id' => 'Tambahkan anggota terlebih dahulu.']);
        }

        if (Buku::whereKey($data['buku_id'])->value('stok') < 1) {
            return back()->withInput()
                ->withErrors(['buku_id' => 'Stok buku tidak tersedia.']);
        }

        DB::transaction(function () use ($data) {
            Peminjaman::create([
                'buku_id' => $data['buku_id'],
                'anggota_id' => $data['anggota_id'],
                'tanggal_pinjam' => $data['tanggal_pinjam'],
                'tanggal_kembali' => $data['tanggal_kembali'] ?? null,
                'tanggal_dikembalikan' => null,
                'status' => 'Dipinjam',
            ]);

            Buku::whereKey($data['buku_id'])->decrement('stok');
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman buku berhasil dicatat.');
    }

    public function edit(Peminjaman $peminjaman)
    {
        $bukus = Buku::orderBy('judul_buku')->get();
        $anggotas = Anggota::orderBy('nama_anggota')->get();

        return view('peminjaman.edit', compact('peminjaman', 'bukus', 'anggotas'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $data = $request->validate([
            'status' => 'required|in:Dipinjam,Dikembalikan',
            'tanggal_dikembalikan' => 'nullable|date',
        ]);

        DB::transaction(function () use ($data, $peminjaman) {
            if ($peminjaman->status !== 'Dikembalikan' && $data['status'] === 'Dikembalikan') {
                $peminjaman->buku()->increment('stok');

                $data['tanggal_dikembalikan'] =
                    $data['tanggal_dikembalikan'] ?? now()->toDateString();
            }

            if ($peminjaman->status === 'Dikembalikan' && $data['status'] === 'Dipinjam') {
                if ($peminjaman->buku->stok < 1) {
                    throw new \RuntimeException('Stok buku tidak tersedia untuk peminjaman ulang.');
                }

                $peminjaman->buku()->decrement('stok');
                $data['tanggal_dikembalikan'] = null;
            }

            $peminjaman->update($data);
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {
            if ($peminjaman->status === 'Dipinjam') {
                $peminjaman->buku()->increment('stok');
            }

            $peminjaman->delete();
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
