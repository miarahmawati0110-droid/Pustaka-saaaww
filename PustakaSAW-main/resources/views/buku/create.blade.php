
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku | PustakaSAW</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #f3f6fc; color: #243047; }
        header { background: #14213d; color: white; padding: 22px 30px; }
        .container { max-width: 750px; margin: 30px auto; padding: 0 20px; }
        .panel { background: white; border-radius: 14px; padding: 25px; box-shadow: 0 5px 20px #172b4d08; }
        .field { margin-bottom: 17px; }
        label { display: block; font-size: 13px; font-weight: bold; margin-bottom: 7px; }
        input { width: 100%; padding: 12px; border: 1px solid #d7deea; border-radius: 8px; font-size: 14px; }
        .btn { display: inline-block; padding: 12px 16px; border: 0; border-radius: 8px; text-decoration: none; cursor: pointer; font-size: 13px; }
        .primary { background: #2563eb; color: white; }
        .secondary { background: #e5eaf3; color: #243047; }
        .error { color: #b91c1c; font-size: 12px; margin-top: 5px; }
        .alert { background: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 8px; margin-bottom: 18px; }
        .actions { display: flex; gap: 10px; margin-top: 22px; }
    </style>
</head>
<body>
    <header>
        <h2>📚 PustakaSAW</h2>
        <div>Form Tambah Buku</div>
    </header>

    <main class="container">
        <section class="panel">
            <h2>Tambah Buku Baru</h2>
            <p>Isi informasi buku di bawah ini.</p>

            @if ($errors->any())
                <div class="alert">Periksa kembali isian form. Ada data yang belum benar.</div>
            @endif

            <form action="{{ route('buku.store') }}" method="POST">
                @csrf

                <div class="field">
                    <label for="kode_buku">Kode Buku *</label>
                    <input id="kode_buku" name="kode_buku" value="{{ old('kode_buku') }}" required>
                    @error('kode_buku') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label for="judul_buku">Judul Buku *</label>
                    <input id="judul_buku" name="judul_buku" value="{{ old('judul_buku') }}" required>
                    @error('judul_buku') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label for="pengarang">Pengarang *</label>
                    <input id="pengarang" name="pengarang" value="{{ old('pengarang') }}" required>
                    @error('pengarang') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label for="penerbit">Penerbit *</label>
                    <input id="penerbit" name="penerbit" value="{{ old('penerbit') }}" required>
                    @error('penerbit') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label for="tahun_terbit">Tahun Terbit</label>
                    <input id="tahun_terbit" name="tahun_terbit" type="number" min="1000" max="2100" value="{{ old('tahun_terbit') }}">
                    @error('tahun_terbit') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label for="kategori">Kategori</label>
                    <input id="kategori" name="kategori" value="{{ old('kategori') }}">
                    @error('kategori') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="field">
                    <label for="stok">Stok *</label>
                    <input id="stok" name="stok" type="number" min="0" value="{{ old('stok', 0) }}" required>
                    @error('stok') <div class="error">{{ $message }}</div> @enderror
                </div>

                <div class="actions">
                    <button type="submit" class="btn primary">Simpan Buku</button>
                    <a href="{{ route('buku.index') }}" class="btn secondary">Batal</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
