
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil SAW - PustakaSAW</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 25px;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 15px;
            margin-top: 22px;
            box-shadow: 0 4px 16px #0f172a0a;
            overflow-x: auto;
        }

        .muted {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 11px 15px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
        }

        .blue { background: #2563eb; color: white; }
        .gray { background: #e2e8f0; color: #334155; }

        .alert {
            padding: 14px;
            margin-top: 16px;
            border-radius: 8px;
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .summary-item {
            background: #f8fafc;
            border-radius: 10px;
            padding: 17px;
        }

        .summary-item strong {
            display: block;
            font-size: 23px;
            margin-top: 8px;
        }

        table {
            width: 100%;
            min-width: 550px;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background: #f8fafc;
            font-size: 13px;
        }

        .rank {
            font-weight: bold;
            font-size: 18px;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 22px;
        }

        @media (max-width: 650px) {
            body { padding: 15px; }
            .summary { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <div>
            <h1>🏆 Hasil Perhitungan SAW</h1>
            <p class="muted">
                Hasil perangkingan anggota menggunakan metode
                Simple Additive Weighting.
            </p>
        </div>

        <a href="{{ route('dashboard') }}" class="btn gray">
            ← Dashboard
        </a>
    </div>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    <div class="summary">
        <div class="summary-item">
            <span class="muted">Jumlah Hasil</span>
            <strong>{{ $hasilSaws->count() }}</strong>
        </div>

        <div class="summary-item">
            <span class="muted">Jumlah Bobot</span>
            <strong>{{ number_format($totalBobot, 2, ',', '.') }}</strong>
        </div>

        <div class="summary-item">
            <span class="muted">Metode</span>
            <strong style="font-size:20px">SAW</strong>
        </div>
    </div>

    <div class="card">
        <h2>Daftar Peringkat Anggota</h2>

        <p class="muted">
            Nilai akhir yang lebih tinggi menunjukkan peringkat yang lebih tinggi,
            berdasarkan kriteria dan bobot yang telah dimasukkan.
        </p>

        @if (abs((float) $totalBobot - 1) > 0.0001)
            <div class="alert error">
                Total bobot belum sama dengan 1,00. Periksa kembali bobot pada Data Kriteria
                sebelum menghitung SAW.
            </div>
        @endif

        <form action="{{ route('hasil-saw.hitung') }}" method="POST"
              onsubmit="return confirm('Hitung ulang hasil SAW sekarang?')">
            @csrf
            <button type="submit" class="btn blue">
                🔄 Hitung Ulang SAW
            </button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Nomor Anggota</th>
                    <th>Nama Anggota</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($hasilSaws as $hasil)
                    <tr>
                        <td class="rank">
                            @if ($hasil->peringkat == 1)
                                🥇
                            @elseif ($hasil->peringkat == 2)
                                🥈
                            @elseif ($hasil->peringkat == 3)
                                🥉
                            @else
                                {{ $hasil->peringkat ?? '-' }}
                            @endif
                        </td>

                        <td>
                            {{ $hasil->anggota->nomor_anggota ?? '-' }}
                        </td>

                        <td>
                            {{ $hasil->anggota->nama_anggota ?? 'Anggota tidak ditemukan' }}
                        </td>

                        <td>
                            <strong>
                                {{ number_format((float) $hasil->nilai_akhir, 6, ',', '.') }}
                            </strong>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;padding:30px">
                            Belum ada hasil perhitungan SAW.
                            <br><br>
                            Lengkapi Data Kriteria dan Data Penilaian,
                            kemudian tekan tombol Hitung Ulang SAW.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="actions">
            <a href="{{ route('kriteria.index') }}" class="btn gray">
                ⚙️ Data Kriteria
            </a>

            <a href="{{ route('penilaian.index') }}" class="btn gray">
                📝 Data Penilaian
            </a>
        </div>
    </div>

</div>
</body>
</html>
