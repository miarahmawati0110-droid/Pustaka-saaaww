
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman - PustakaSAW</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0; font-family: Arial, sans-serif;
            background: #f1f5f9; color: #1e293b;
        }
        .container { max-width: 800px; margin: 35px auto; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap; }
        h1 { margin-bottom: 6px; }
        .muted { color: #64748b; }
        .card { background: white; padding: 28px; border-radius: 16px; box-shadow: 0 5px 20px #0f172a0d; margin-top: 22px; }
        label { display: block; font-weight: bold; margin: 17px 0 8px; }
        input, select {
            width: 100%; padding: 12px; border: 1px solid #cbd5e1;
            border-radius: 8px; font-size: 15px; background: white;
        }
        .btn {
            display: inline-block; padding: 11px 16px; border: 0;
            border-radius: 8px; text-decoration: none; cursor: pointer;
            font-size: 14px; font-weight: bold;
        }
        .primary { background: #2563eb; color: white; }
        .secondary { background: #e2e8f0; color: #334155; }
        .actions { display: flex; gap: 10px; margin-top: 25px; flex-wrap: wrap; }
        .alert { padding: 13px; border-radius: 8px; margin-top: 15px; }
        .error { background: #fee2e2; color: #991b1b; }
        .info { background: #dbeafe; color: #1e40af; }
        .field-error { color: #dc2626; font-size: 13px; margin-top: 6px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>Tambah Peminjaman</h1>
            <div class="muted">Catat peminjaman buku perpustakaan.</div>
        </div>
        <a class="btn secondary" href="{{ route('peminjaman.index') }}">← Kembali</a>
    </div>

    @if ($errors->any())
        <div class="alert error">
            <strong>Periksa kembali data berikut:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($bukus->isEmpty())
        <div class="alert info">
            Stok buku belum tersedia. Tambahkan buku atau pastikan stok buku lebih dari 0 sebelum meminjam.
            <br><br>
            <a href="{{ route('buku.index') }}">Buka Data Buku</a>
        </div>
    @endif

    @if ($anggotas->isEmpty())
        <div class="alert info">
            Belum ada anggota terdaftar. Tambahkan anggota terlebih dahulu.
            <br><br>
            <a href="{{ route('anggota.index') }}">Buka Data Anggota</a>
        </div>
    @endif

    <div class="card">
        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

            <label for="buku_id">Pilih Buku *</label>
            <select name="buku_id" id="buku_id" required>
                <option value="">-- Pilih Buku --</option>
                @foreach ($bukus as $buku)
                    <option value="{{ $buku->id }}"
                        {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                        {{ $buku->judul_buku }} — Stok: {{ $buku->stok }}
                    </option>
                @endforeach
            </select>
            @error('buku_id') <div class="field-error">{{ $message }}</div> @enderror

            <label for="anggota_id">Pilih Anggota *</label>
            <select name="anggota_id" id="anggota_id" required>
                <option value="">-- Pilih Anggota --</option>
                @foreach ($anggotas as $anggota)
                    <option value="{{ $anggota->id }}"
                        {{ old('anggota_id') == $anggota->id ? 'selected' : '' }}>
                        {{ $anggota->nomor_anggota }} — {{ $anggota->nama_anggota }}
                    </option>
                @endforeach
            </select>
            @error('anggota_id') <div class="field-error">{{ $message }}</div> @enderror

            <label for="tanggal_pinjam">Tanggal Pinjam *</label>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                value="{{ old('tanggal_pinjam', now()->toDateString()) }}" required>
            @error('tanggal_pinjam') <div class="field-error">{{ $message }}</div> @enderror

            <label for="tanggal_kembali">Batas Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                value="{{ old('tanggal_kembali') }}">
            <small class="muted">Isi jika tanggal batas pengembalian sudah ditentukan.</small>
            @error('tanggal_kembali') <div class="field-error">{{ $message }}</div> @enderror

            <div class="actions">
                <button class="btn primary" type="submit"
                    {{ $bukus->isEmpty() || $anggotas->isEmpty() ? 'disabled' : '' }}>
                    Simpan Peminjaman
                </button>
                <a class="btn secondary" href="{{ route('peminjaman.index') }}">Batal</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
