
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Penilaian - PustakaSAW</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; padding: 25px; font-family: Arial, sans-serif; background: #f1f5f9; color: #1e293b; }
        .container { max-width: 1200px; margin: auto; }
        .header { display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap; }
        .card { background: white; padding: 22px; border-radius: 14px; margin-top: 20px; overflow-x: auto; }
        .muted { color: #64748b; font-size: 13px; line-height: 1.6; }
        .btn { display: inline-block; padding: 11px 15px; border: 0; border-radius: 8px; text-decoration: none; cursor: pointer; font-weight: bold; }
        .blue { background: #2563eb; color: white; }
        .gray { background: #e2e8f0; color: #334155; }
        .alert { padding: 13px; border-radius: 8px; margin-top: 15px; background: #dcfce7; color: #166534; }
        .error { background: #fee2e2; color: #991b1b; }
        table { width: 100%; border-collapse: collapse; min-width: 700px; }
        th, td { padding: 12px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 13px; }
        th { background: #f8fafc; }
        input[type=number] { width: 100px; padding: 9px; border: 1px solid #cbd5e1; border-radius: 7px; }
        .bottom { margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>📝 Data Penilaian</h1>
            <p class="muted">Masukkan nilai setiap anggota berdasarkan seluruh kriteria SAW.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn gray">← Dashboard</a>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert error">
            <strong>Periksa kembali nilai yang dimasukkan:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($kriterias->isEmpty() || $anggotas->isEmpty())
        <div class="card">
            <p>Data kriteria dan anggota diperlukan sebelum mengisi penilaian.</p>
            <p><a href="{{ route('kriteria.index') }}">Kelola Data Kriteria</a></p>
            <p><a href="{{ route('anggota.index') }}">Kelola Data Anggota</a></p>
        </div>
    @else
        <div class="card">
            <p class="muted">
                Masukkan angka 0 atau lebih. Gunakan skala penilaian yang konsisten untuk setiap kriteria.
                Nilai pada kriteria bertipe cost harus lebih besar dari 0.
            </p>

            <form action="{{ route('penilaian.simpan') }}" method="POST">
                @csrf
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Anggota</th>
                            @foreach($kriterias as $kriteria)
                                <th>
                                    {{ $kriteria->kode_kriteria }}<br>
                                    {{ $kriteria->nama_kriteria }}<br>
                                    <span class="muted">
                                        {{ ucfirst($kriteria->jenis) }} |
                                        Bobot {{ number_format($kriteria->bobot, 2) }}
                                    </span>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($anggotas as $anggota)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $anggota->nama_anggota }}</strong><br>
                                <span class="muted">{{ $anggota->nomor_anggota }}</span>
                            </td>
                            @foreach($kriterias as $kriteria)
                                @php
                                    $key = $anggota->id . '-' . $kriteria->id;
                                    $nilaiLama = $nilaiTersimpan->get($key)?->nilai;
                                @endphp
                                <td>
                                    <input
                                        type="number"
                                        step="any"
                                        min="0"
                                        name="nilai[{{ $anggota->id }}][{{ $kriteria->id }}]"
                                        value="{{ old('nilai.'.$anggota->id.'.'.$kriteria->id, $nilaiLama) }}"
                                        required
                                        aria-label="Nilai {{ $kriteria->nama_kriteria }} untuk {{ $anggota->nama_anggota }}"
                                    >
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="bottom">
                    <button class="btn blue" type="submit">Simpan Semua Penilaian</button>
                    <a href="{{ route('hasil-saw.index') }}" class="btn gray">Lihat Hasil SAW</a>
                </div>
            </form>
        </div>
    @endif
</div>
</body>
</html>
