<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::orderBy('kode_kriteria')->get();

        return view('kriteria.index', compact('kriterias'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_kriteria' => 'required|string|max:255|unique:kriterias,kode_kriteria',
            'nama_kriteria' => 'required|string|max:255',
            'jenis' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|min:0|max:1',
            'keterangan' => 'nullable|string',
        ]);

        Kriteria::create($data);

        return redirect()->route('kriteria.index')
            ->with('success', 'Data kriteria berhasil ditambahkan.');
    }

    public function edit(Kriteria $kriteria)
    {
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $data = $request->validate([
            'kode_kriteria' => 'required|string|max:255|unique:kriterias,kode_kriteria,' . $kriteria->id,
            'nama_kriteria' => 'required|string|max:255',
            'jenis' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|min:0|max:1',
            'keterangan' => 'nullable|string',
        ]);

        $kriteria->update($data);

        return redirect()->route('kriteria.index')
            ->with('success', 'Data kriteria berhasil diperbarui.');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();

        return redirect()->route('kriteria.index')
            ->with('success', 'Data kriteria berhasil dihapus.');
    }
}
