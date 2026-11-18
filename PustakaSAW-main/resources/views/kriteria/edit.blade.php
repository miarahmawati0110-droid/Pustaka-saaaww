
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kriteria - PustakaSAW</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 30px 16px;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }
        .container {
            max-width: 650px;
            margin: auto;
        }
        .card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,.06);
        }
        h1 { margin-bottom: 8px; }
        .muted { color: #64748b; margin-bottom: 25px; }
        label {
            display: block;
            font-weight: bold;
            margin: 16px 0 7px;
        }
        input, select, textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
        }
        textarea { min-height: 90px; resize: vertical; }
        .actions {
            display: flex;
            gap: 10px;
            margin-top: 22px;
        }
        .btn {
            display: inline-block;
            padding: 11px 16px;
            border: 0;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }
        .save { background: #2563eb; color: white; }
        .back { background: #e2e8f0; color: #1e293b; }
        .error { color: #dc2626; margin-top: 5px; font-size: 13px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Kriteria</h1>
    <p class="muted">Perbarui informasi kriteria penilaian SAW.</p>

    <div class="card">
        <form action="{{ url('/kriteria/' . request()->route('kriterium')) }}"
              method="POST">
            @csrf
            @method('PUT')

            <label for="kode_kriteria">Kode Kriteria *</label>
            <input id="kode_kriteria" name="kode_kriteria"
                   value="{{ old('kode_kriteria', $kriteria->kode_kriteria) }}"
                   required>
            @error('kode_kriteria')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="nama_kriteria">Nama Kriteria *</label>
            <input id="nama_kriteria" name="nama_kriteria"
                   value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}"
                   required>
            @error('nama_kriteria')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="jenis">Jenis Kriteria *</label>
            <select id="jenis" name="jenis" required>
                <option value="benefit"
                    {{ old('jenis', $kriteria->jenis) == 'benefit' ? 'selected' : '' }}>
                    Benefit (semakin besar semakin baik)
                </option>
                <option value="cost"
                    {{ old('jenis', $kriteria->jenis) == 'cost' ? 'selected' : '' }}>
                    Cost (semakin kecil semakin baik)
                </option>
            </select>
            @error('jenis')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="bobot">Bobot *</label>
            <input type="number" id="bobot" name="bobot"
                   value="{{ old('bobot', $kriteria->bobot) }}"
                   min="0" max="1" step="0.01" required>
            @error('bobot')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="keterangan">Keterangan</label>
            <textarea id="keterangan" name="keterangan">{{ old('keterangan', $kriteria->keterangan) }}</textarea>
            @error('keterangan')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="actions">
                <button type="submit" class="btn save">Simpan Perubahan</button>
                <a href="{{ route('kriteria.index') }}" class="btn back">Kembali</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
