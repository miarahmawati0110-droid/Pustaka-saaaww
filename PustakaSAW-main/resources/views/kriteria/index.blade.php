
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Kriteria - PustakaSAW</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; padding: 25px; font-family: Arial, sans-serif; background: #f1f5f9; color: #1e293b; }
        .container { max-width: 1100px; margin: auto; }
        .header { display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap; }
        .card { background: white; border-radius: 14px; padding: 22px; margin-top: 20px; box-shadow: 0 4px 15px #0f172a0a; overflow-x: auto; }
        .btn { display: inline-block; padding: 10px 14px; border-radius: 8px; text-decoration: none; border: 0; cursor: pointer; font-size: 13px; font-weight: bold; }
        .blue { background: #2563eb; color: white; }
        .gray { background: #e2e8f0; color: #334155; }
        .red { background: #fee2e2; color: #b91c1c; }
        .muted { color: #64748b; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; min-width: 650px; }
        th, td { text-align: left; padding: 13px; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        th { background: #f8fafc; }
        .alert { padding: 13px; border-radius: 8px; margin-top: 15px; background: #dcfce7; color: #166534; }
        .error { background: #fee2e2; color: #991b1b; }
        .actions { display: flex; gap: 6px; align-items: center; }
        form { margin: 0; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>⚙️ Data Kriteria</h1>
            <p class="muted">Kelola kriteria dan bobot untuk perhitungan SAW.</p>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" class="btn gray">← Dashboard</a>
            <a href="{{ route('kriteria.create') }}" class="btn blue">+ Tambah Kriteria</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    <div class="card">
        <p class="muted">Jumlah kriteria: <strong>{{ $kriterias->count() }}</strong></p>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode</th>
                    <th>Nama Kriteria</th>
                    <th>Jenis</th>
                    <th>Bobot</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($kriterias as $kriteria)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kriteria->kode_kriteria }}</td>
                    <td>{{ $kriteria->nama_kriteria }}</td>
                    <td>{{ ucfirst($kriteria->jenis) }}</td>
                    <td>{{ number_format($kriteria->bobot, 2, ',', '.') }}</td>
                    <td>{{ $kriteria->keterangan ?: '-' }}</td>
                    <td>
                        <div class="actions">
                            <a class="btn blue" href="{{ route('kriteria.edit', $kriteria) }}">Edit</a>
                            <form action="{{ route('kriteria.destroy', $kriteria) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus kriteria ini? Nilai terkait juga dapat terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button class="btn red" type="submit">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:30px">
                        Belum ada data kriteria. Klik Tambah Kriteria untuk memulai.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <p class="muted">
            Total bobot saat ini:
            <strong>{{ number_format($kriterias->sum('bobot'), 2, ',', '.') }}</strong>.
            Target total bobot adalah 1,00.
        </p>
    </div>
</div>
</body>
</html>
