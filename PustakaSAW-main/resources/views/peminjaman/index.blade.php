
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Peminjaman - PustakaSAW</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { margin: 0; background: #f4f7fb; color: #263248; }
        .container { max-width: 1200px; margin: 35px auto; padding: 20px; }
        .header, .panel { background: white; padding: 25px; border-radius: 14px; margin-bottom: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; gap: 15px; flex-wrap: wrap; }
        h1 { margin: 0 0 8px; font-size: 26px; }
        p { color: #64748b; }
        .btn { display: inline-block; padding: 10px 14px; border-radius: 8px; border: none; text-decoration: none; cursor: pointer; font-size: 13px; }
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
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>🔄 Data Peminjaman</h1>
            <p>Kelola peminjaman dan pengembalian buku perpustakaan.</p>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" class="btn gray">← Dashboard</a>
            <a href="{{ route('peminjaman.create') }}" class="btn blue">+ Tambah Peminjaman</a>
        </div>
    </div>

    <div class="panel">
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <h3>Daftar Peminjaman</h3>
        <p>Total transaksi: {{ $peminjamans->count() }}</p>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Buku</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Tanggal Dikembalikan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $peminjaman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $peminjaman->buku->judul_buku ?? 'Buku tidak ditemukan' }}</td>
                            <td>{{ $peminjaman->anggota->nama_anggota ?? 'Anggota tidak ditemukan' }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam }}</td>
                            <td>{{ $peminjaman->tanggal_kembali ?? '-' }}</td>
                            <td>{{ $peminjaman->tanggal_dikembalikan ?? '-' }}</td>
                            <td>{{ $peminjaman->status }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('peminjaman.edit', $peminjaman) }}" class="btn orange">Edit</a>
                                    <form action="{{ route('peminjaman.destroy', $peminjaman) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
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
                                Belum ada transaksi peminjaman. Klik Tambah Peminjaman untuk memulai.
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
