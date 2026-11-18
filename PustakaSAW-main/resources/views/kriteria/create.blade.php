
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Kriteria - PustakaSAW</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; padding: 25px; font-family: Arial, sans-serif; background: #f1f5f9; color: #1e293b; }
        .container { max-width: 700px; margin: auto; }
        .card { background: white; padding: 25px; margin-top: 20px; border-radius: 14px; }
        label { display: block; margin: 16px 0 7px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font: inherit; }
        .btn { display: inline-block; padding: 11px 15px; border: 0; border-radius: 8px; text-decoration: none; cursor: pointer; font-weight: bold; }
        .blue { background: #2563eb; color: white; }
        .gray { background: #e2e8f0; color: #334155; }
        .error { color: #dc2626; font-size: 13px; margin-top: 5px; }
        .actions { display: flex; gap: 10px; margin-top: 22px; }
        .muted { color: #64748b; font-size: 13px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Tambah Kriteria</h1>
    <p class="muted">Masukkan informasi kriteria SAW.</p>

    <div class="card">
        <form action="{{ route('kriteria.store') }}" method="POST">
            @csrf

            <label for="kode_kriteria">Kode Kriteria *</label>
            <input id="kode_kriteria" name="kode_kriteria" value="{{ old('kode_kriteria') }}" required>
            @error('kode_kriteria') <div class="error">{{ $message }}</div> @enderror

            <label for="nama_kriteria">Nama Kriteria *</label>
            <input id="nama_kriteria" name="nama_kriteria" value="{{ old('nama_kriteria') }}" required>
            @error('nama_kriteria') <div class="error">{{ $message }}</div> @enderror

            <label for="jenis">Jenis Kriteria *</label>
            <select id="jenis" name="jenis" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="benefit" @selected(old('jenis') === 'benefit')>Benefit (semakin besar semakin baik)</option>
                <option value="cost" @selected(old('jenis') === 'cost')>Cost (semakin kecil semakin baik)</option>
            </select>
            @error('jenis') <div class="error">{{ $message }}</div> @enderror

            <label for="bobot">Bobot (0 sampai 1) *</label>
            <input id="bobot" type="number" name="bobot" min="0" max="1" step="0.01" value="{{ old('bobot', '0.20') }}" required>
            <p class="muted">Contoh: 0,20 berarti bobot 20%. Total seluruh bobot harus 1,00.</p>
            @error('bobot') <div class="error">{{ $message }}</div> @enderror

            <label for="keterangan">Keterangan</label>
            <textarea id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
            @error('keterangan') <div class="error">{{ $message }}</div> @enderror

            <div class="actions">
                <button type="submit" class="btn blue">Simpan Kriteria</button>
                <a href="{{ route('kriteria.index') }}" class="btn gray">Batal</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
