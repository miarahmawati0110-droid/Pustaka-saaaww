
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku | PustakaSAW</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #f3f6fc; color: #243047; }
        .header { background: #14213d; color: white; padding: 22px 30px; }
        .header h2 { margin: 0 0 8px; }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .top { display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap; margin-bottom: 20px; }
        .btn { display: inline-block; border: 0; border-radius: 8px; padding: 11px 15px; text-decoration: none; cursor: pointer; font-size: 13px; }
        .primary { background: #2563eb; color: white; }
        .secondary { background: #e5eaf3; color: #243047; }
        .edit { background: #fff0c2; color: #825b00; }
        .delete { background: #fee2e2; color: #b91c1c; }
        .panel { background: white; border-radius: 14px; padding: 22px; box-shadow: 0 5px 20px #172b4d08; }
        .message { background: #dcfce7; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 16px; }
        .table-wrap { overflow-x: auto; }
        table { border-collapse: collapse; width: 100%; font-size: 13px; }
        th, td { padding: 14px 10px; border-bottom: 1px solid #edf0f6; text-align: left; }
        th { color: #718096; }
        .actions { display: flex; gap: 6px; align-items: center; }
        .actions form { margin: 0; }
        .empty { text-align: center; color: #718096; padding: 25px; }
        @media(max-width: 600px) { .panel { padding: 12px; } th, td { padding: 10px 8px; } }
    </style>
</head>
<body>
    <header class="header">
        <h2>📚 PustakaSAW</h2>
        <div>Manajemen Data Buku Perpustakaan</div>
    </header>

    <main class="container">
        <div class="top">
            <div>
                <h2>Data Buku</h2>
                <p>Kelola koleksi buku perpustakaan.</p>
            </div>
            <div>
                <a href="{{ route('dashboard') }}" class="btn secondary">← Dashboard</a>
                <a href="{{ route('buku.create') }}" class="btn primary">+ Tambah Buku</a>
            </div>
        </div>

        @if (session('success'))
            <div class="message">{{ session('success') }}</div>
        @endif

        <section class="panel">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bukus as $buku)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $buku->kode_buku }}</td>
                                <td>{{ $buku->judul_buku }}</td>
                                <td>{{ $buku->pengarang }}</td>
                                <td>{{ $buku->penerbit }}</td>
                                <td>{{ $buku->tahun_terbit ?? '-' }}</td>
                                <td>{{ $buku->kategori ?? '-' }}</td>
                                <td>{{ $buku->stok }}</td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('buku.edit', $buku) }}" class="btn edit">Edit</a>
                                        <form action="{{ route('buku.destroy', $buku) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn delete">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="empty">Belum ada data buku. Silakan tambah buku pertama.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
