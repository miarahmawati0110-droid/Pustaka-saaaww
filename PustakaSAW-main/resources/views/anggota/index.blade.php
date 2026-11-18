
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Anggota - PustakaSAW</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { margin: 0; background: #f4f7fb; color: #263248; }
        .container { max-width: 1200px; margin: 35px auto; padding: 20px; }
        .header, .panel { background: white; padding: 25px; border-radius: 14px; margin-bottom: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; gap: 15px; flex-wrap: wrap; }
        h1 { margin: 0 0 8px; font-size: 26px; }
        p { color: #64748b; }
        .btn { display: inline-block; padding: 11px 15px; border-radius: 8px; text-decoration: none; border: none; cursor: pointer; font-size: 14px; }
        .blue { background: #2563eb; color: white; }
        .gray { background: #e2e8f0; color: #263248; }
        .orange { background: #f59e0b; color: white; }
        .red { background: #dc2626; color: white; }
        .success { background: #dcfce7; color: #166534; padding: 13px; border-radius: 8px; margin-bottom: 18px; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 850px; }
        th, td { padding: 14px 12px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background: #eff6ff; color: #1e40af; }
        .actions { display: flex; gap: 7px; align-items: center; }
        form { margin: 0; }
        .empty { text-align: center; padding: 30px; color: #64748b; }
        @media (max-width: 600px) {
            .container { margin: 10px auto; padding: 12px; }
            .header, .panel { padding: 18px; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>👥 Data Anggota</h1>
            <p>Kelola anggota perpustakaan PustakaSAW.</p>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" class="btn gray">← Dashboard</a>
            <a href="{{ route('anggota.create') }}" class="btn blue">+ Tambah Anggota</a>
        </div>
    </div>

    <div class="panel">
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <h3>Daftar Anggota Perpustakaan</h3>
        <p>Total anggota: {{ $anggotas->count() }}</p>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor Anggota</th>
                        <th>Nama Anggota</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggotas as $anggota)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $anggota->nomor_anggota }}</td>
                            <td>{{ $anggota->nama_anggota }}</td>
                            <td>{{ $anggota->jenis_kelamin ?? '-' }}</td>
                            <td>{{ $anggota->alamat ?? '-' }}</td>
                            <td>{{ $anggota->no_telepon ?? '-' }}</td>
                            <td>{{ $anggota->tanggal_daftar ?? '-' }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('anggota.edit', $anggota) }}" class="btn orange">Edit</a>
                                    <form action="{{ route('anggota.destroy', $anggota) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn red">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty">
                                Belum ada data anggota. Klik Tambah Anggota untuk memulai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
