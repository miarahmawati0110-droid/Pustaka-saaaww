
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman - PustakaSAW</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #f1f5f9; color: #1e293b; }
        .container { max-width: 800px; margin: 35px auto; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap; }
        h1 { margin-bottom: 6px; }
        .muted { color: #64748b; }
        .card { background: white; padding: 28px; border-radius: 16px; box-shadow: 0 5px 20px #0f172a0d; margin-top: 22px; }
        label { display: block; font-weight: bold; margin: 18px 0 8px; }
        input, select { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; background: white; }
        input[readonly] { background: #f8fafc; }
        .btn { display: inline-block; padding: 11px 16px; border: 0; border-radius: 8px; text-decoration: none; cursor: pointer; font-size: 14px; font-weight: bold; }
        .primary { background: #2563eb; color: white; }
        .secondary { background: #e2e8f0; color: #334155; }
        .actions { display: flex; gap: 10px; margin-top: 25px; flex-wrap: wrap; }
        .alert { background: #fee2e2; color: #991b1b; padding: 13px; border-radius: 8px; margin-top: 15px; }
        .field-error { color: #dc2626; font-size: 13px; margin-top: 6px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>Edit Peminjaman</h1>
            <div class="muted">Perbarui status peminjaman atau pengembalian buku.</div>
        </div>
        <a class="btn secondary" href="{{ route('peminjaman.index') }}">← Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert">
            <strong>Data belum dapat disimpan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <form action="{{ route('peminjaman.update', $peminjaman) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Buku</label>
            <input type="text"
                value="{{ $peminjaman->buku->judul_buku ?? 'Buku tidak ditemukan' }}"
                readonly>

            <label>Anggota</label>
            <input type="text"
                value="{{ $peminjaman->anggota->nama_anggota ?? 'Anggota tidak ditemukan' }}"
                readonly>

            <label>Tanggal Pinjam</label>
            <input type="date"
                value="{{ $peminjaman->tanggal_pinjam ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('Y-m-d') : '' }}"
                readonly>

            <label>Batas Tanggal Kembali</label>
            <input type="date"
                value="{{ $peminjaman->tanggal_kembali ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('Y-m-d') : '' }}"
                readonly>

            <label for="status">Status Peminjaman *</label>
            <select name="status" id="status" required>
                <option value="Dipinjam"
                    {{ old('status', $peminjaman->status) == 'Dipinjam' ? 'selected' : '' }}>
                    Dipinjam
                </option>
                <option value="Dikembalikan"
                    {{ old('status', $peminjaman->status) == 'Dikembalikan' ? 'selected' : '' }}>
                    Dikembalikan
                </option>
            </select>
            @error('status') <div class="field-error">{{ $message }}</div> @enderror

            <label for="tanggal_dikembalikan">Tanggal Buku Dikembalikan</label>
            <input type="date" name="tanggal_dikembalikan" id="tanggal_dikembalikan"
                value="{{ old('tanggal_dikembalikan', $peminjaman->tanggal_dikembalikan ? \Carbon\Carbon::parse($peminjaman->tanggal_dikembalikan)->format('Y-m-d') : '') }}">
            @error('tanggal_dikembalikan') <div class="field-error">{{ $message }}</div> @enderror

            <div class="actions">
                <button class="btn primary" type="submit">Simpan Perubahan</button>
                <a class="btn secondary" href="{{ route('peminjaman.index') }}">Batal</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
