
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Anggota - PustakaSAW</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body { margin: 0; padding: 25px; background: #f4f7fb; color: #263248; }
        .panel { max-width: 700px; margin: 20px auto; background: white; padding: 30px; border-radius: 16px; }
        h1 { margin-top: 0; }
        p { color: #64748b; }
        label { display: block; margin: 17px 0 7px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; }
        textarea { min-height: 85px; resize: vertical; }
        .btn { display: inline-block; padding: 12px 17px; border: 0; border-radius: 8px; text-decoration: none; cursor: pointer; margin-top: 22px; }
        .blue { background: #2563eb; color: white; }
        .gray { background: #e2e8f0; color: #263248; }
        .error { color: #dc2626; font-size: 13px; margin-top: 5px; }
    </style>
</head>
<body>
<div class="panel">
    <h1>➕ Tambah Anggota</h1>
    <p>Masukkan informasi anggota perpustakaan.</p>

    <form action="{{ route('anggota.store') }}" method="POST">
        @csrf

        <label>Nomor Anggota *</label>
        <input type="text" name="nomor_anggota" value="{{ old('nomor_anggota') }}" placeholder="Contoh: AGT-001" required>
        @error('nomor_anggota') <div class="error">{{ $message }}</div> @enderror

        <label>Nama Anggota *</label>
        <input type="text" name="nama_anggota" value="{{ old('nama_anggota') }}" placeholder="Nama lengkap" required>
        @error('nama_anggota') <div class="error">{{ $message }}</div> @enderror

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin">
            <option value="">-- Pilih jenis kelamin --</option>
            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>

        <label>Alamat</label>
        <textarea name="alamat" placeholder="Alamat anggota">{{ old('alamat') }}</textarea>

        <label>Nomor Telepon</label>
        <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="Contoh: 08123456789">

        <label>Tanggal Daftar</label>
        <input type="date" name="tanggal_daftar" value="{{ old('tanggal_daftar') }}">

        <button type="submit" class="btn blue">💾 Simpan Anggota</button>
        <a href="{{ route('anggota.index') }}" class="btn gray">Batal</a>
    </form>
</div>
</body>
</html>
