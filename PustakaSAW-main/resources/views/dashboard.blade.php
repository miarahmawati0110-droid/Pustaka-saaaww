<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PustakaSAW</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
*{box-sizing:border-box}:root{--bg:#f3f6fc;--card:#ffffff;--text:#182b55;--muted:#8190aa;--line:#e6ebf3;--primary:#625cf0}body.dark{--bg:#111827;--card:#1b2639;--text:#edf2ff;--muted:#a4b1ca;--line:#303c55}body{margin:0;background:var(--bg);color:var(--text);font-family:"Segoe UI",Arial,sans-serif;transition:background .2s,color .2s}a{color:inherit;text-decoration:none}button{font:inherit}.layout{display:flex;min-height:100vh}.sidebar{width:235px;flex-shrink:0;background:var(--card);border-right:1px solid var(--line);padding:25px 16px}.brand{display:flex;align-items:center;gap:10px;font-size:21px;font-weight:800;margin:0 8px 6px}.brand-icon{background:var(--primary);color:white;padding:11px;border-radius:12px}.brand-sub{font-size:12px;color:var(--muted);margin:0 0 28px 57px}.label{font-size:11px;color:var(--muted);font-weight:800;letter-spacing:1px;margin:23px 10px 9px}.nav{display:flex;align-items:center;gap:11px;padding:12px 11px;border-radius:10px;margin:4px 0;color:var(--muted);font-size:14px}.nav:hover,.nav.active{background:#eeedff;color:var(--primary);font-weight:700}body.dark .nav:hover,body.dark .nav.active{background:#343158;color:#c4c0ff}.main{flex:1;min-width:0;padding:27px}.topbar{display:flex;justify-content:space-between;align-items:center;gap:14px;margin-bottom:24px}h1{font-size:27px;margin:0 0 6px}h2{font-size:19px;margin:0}h3{font-size:17px;margin:0 0 8px}.muted{color:var(--muted);font-size:13px}.top-actions{display:flex;align-items:center;gap:10px}.theme-btn,.profile{border:1px solid var(--line);background:var(--card);color:var(--text);border-radius:12px;padding:11px 13px}.theme-btn{cursor:pointer;font-weight:700}.profile{display:flex;align-items:center;gap:10px}.avatar{display:grid;place-items:center;width:37px;height:37px;border-radius:50%;background:#e8e7ff;color:var(--primary);font-weight:800}.profile small{display:block;color:var(--muted);margin-top:3px}.stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px}.card{background:var(--card);border:1px solid var(--line);border-radius:17px;padding:19px;min-width:0;box-shadow:0 4px 16px #25345a05}.stat-top{display:flex;justify-content:space-between;align-items:center;gap:8px}.stat-title{font-size:13px;color:var(--muted)}.stat-icon{width:42px;height:42px;border-radius:12px;display:grid;place-items:center;font-size:20px;background:#eeedff;flex-shrink:0}.blue{background:#e8f2ff}.pink{background:#ffedf0}.green{background:#e5f8ef}.orange{background:#fff2e1}.stat-number{font-size:30px;font-weight:800;margin:12px 0 5px}.section{margin-top:25px}.section-head{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:14px}.quick{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:13px}.quick-link{display:flex;align-items:center;gap:12px;transition:.2s}.quick-link:hover{transform:translateY(-3px);border-color:#bcb8ff}.quick-link strong{font-size:14px;display:block}.quick-link small{display:block;color:var(--muted);margin-top:5px;font-size:12px}.charts{display:grid;grid-template-columns:minmax(0,1.4fr) minmax(260px,1fr);gap:17px;margin-top:20px}.chart-box{position:relative;height:260px;margin-top:18px}.chart-box.ranking{height:390px}.calendar-head{display:flex;align-items:center;justify-content:space-between;margin:18px 0}.calendar-head button{background:#eeedff;color:var(--primary);border:0;border-radius:8px;padding:7px 12px;cursor:pointer}.calendar{display:grid;grid-template-columns:repeat(7,minmax(0,1fr));gap:4px;text-align:center}.calendar div{padding:9px 0;font-size:12px;border-radius:7px}.calendar .weekday{color:var(--muted);font-weight:700}.calendar .today{background:var(--primary);color:#fff;font-weight:800}.calendar .first{background:#eeedff;color:var(--primary)}body.dark .calendar .first,body.dark .calendar-head button{background:#343158;color:#c4c0ff}.lower{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:17px;margin-top:20px}.circle-row{display:flex;align-items:center;gap:13px;margin:19px 0}.circle{width:55px;height:55px;border-radius:50%;display:grid;place-items:center;flex-shrink:0;background:conic-gradient(var(--c) 100%,#e7edf5 0);position:relative}.circle:before{content:"";position:absolute;inset:6px;background:var(--card);border-radius:50%}.circle span{position:relative;font-size:12px;font-weight:800}.circle-row strong{font-size:13px}.circle-row small{display:block;color:var(--muted);font-size:12px;margin-top:5px}.table-wrap{overflow-x:auto}table{width:100%;border-collapse:collapse;min-width:360px;margin-top:14px}th,td{text-align:left;padding:13px 10px;border-bottom:1px solid var(--line);font-size:13px}th{background:#f6f8fc;color:#697895}body.dark th{background:#253147;color:#d5def0}.status{display:inline-block;padding:5px 9px;border-radius:15px;background:#fff0c9;color:#946300;font-size:11px}.rank{display:inline-grid;place-items:center;background:#eeedff;color:var(--primary);width:28px;height:28px;border-radius:8px;font-weight:800}.empty{text-align:center;color:var(--muted);padding:20px;line-height:1.6}.guide{padding:13px 0;border-bottom:1px solid var(--line);font-size:13px}.guide:last-child{border:0}footer{text-align:center;color:var(--muted);font-size:12px;padding:27px 0 5px}@media(max-width:1050px){.sidebar{width:205px}.main{padding:19px}.stats{grid-template-columns:repeat(2,minmax(0,1fr))}.quick{grid-template-columns:repeat(2,minmax(0,1fr))}.charts,.lower{grid-template-columns:1fr}}@media(max-width:680px){.layout{display:block}.sidebar{width:100%;padding:14px;border-right:0;border-bottom:1px solid var(--line)}.brand-sub,.label{display:none}.brand{margin-bottom:12px}.sidebar nav{display:flex;overflow-x:auto;gap:4px}.nav{white-space:nowrap;flex-shrink:0;font-size:12px;padding:10px}.main{padding:14px}.topbar{align-items:flex-start}.topbar h1{font-size:22px}.top-actions{flex-direction:column;align-items:flex-end}.profile{padding:6px}.profile div:last-child{display:none}.theme-btn{padding:9px}.theme-btn span:last-child{display:none}.stats{gap:9px}.card{padding:13px}.stat-number{font-size:25px}.quick{grid-template-columns:1fr}.chart-box{height:225px}.chart-box.ranking{height:380px}.section-head .muted{display:none}}.book-hero{position:relative;display:flex;align-items:center;min-height:245px;overflow:hidden;margin:0 0 22px;padding:30px;border-radius:20px;color:#fff;background:linear-gradient(90deg,rgba(24,35,76,.94) 0%,rgba(37,45,94,.78) 48%,rgba(37,45,94,.16) 100%),url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1500&q=85') center 48% / cover;box-shadow:0 12px 28px rgba(42,51,100,.14)}.book-hero-content{position:relative;z-index:1;max-width:590px}.hero-label{display:inline-flex;align-items:center;gap:7px;padding:7px 11px;border:1px solid rgba(255,255,255,.3);border-radius:999px;background:rgba(255,255,255,.12);font-size:11px;font-weight:800;letter-spacing:.8px;text-transform:uppercase}.book-hero h2{margin:14px 0 9px;font-size:clamp(23px,3vw,34px);line-height:1.2}.book-hero p{max-width:490px;margin:0;color:#e6eaff;font-size:14px;line-height:1.7}.hero-link{display:inline-flex;align-items:center;gap:8px;margin-top:18px;padding:11px 15px;border-radius:10px;background:#fff;color:#4f46c8;font-size:13px;font-weight:800;transition:transform .2s,box-shadow .2s}.hero-link:hover{transform:translateY(-2px);box-shadow:0 7px 18px #0002}.book-showcase{margin:0 0 24px}.book-showcase-head{display:flex;align-items:flex-end;justify-content:space-between;gap:12px;margin-bottom:13px}.book-showcase-head h2{margin-bottom:5px}.book-gallery{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:15px}.book-tile{overflow:hidden;min-width:0;border:1px solid var(--line);border-radius:16px;background:var(--card);box-shadow:0 4px 16px #25345a05;transition:transform .2s,box-shadow .2s}.book-tile:hover{transform:translateY(-4px);box-shadow:0 12px 24px #25345a12}.book-cover{display:block;width:100%;height:155px;object-fit:cover;background:#e8ebf4}.book-tile-info{padding:13px 14px 15px}.book-tile-info strong{display:block;margin-bottom:5px;font-size:14px}.book-tile-info p{margin:0;color:var(--muted);font-size:12px;line-height:1.5}.book-tag{display:inline-block;margin-top:10px;padding:5px 8px;border-radius:7px;background:#eeedff;color:#625cf0;font-size:10px;font-weight:800}body.dark .book-tag{background:#343158;color:#c4c0ff}@media(max-width:680px){.book-hero{min-height:235px;padding:22px;background-position:center}.book-hero p{font-size:13px}.book-gallery{grid-template-columns:1fr}.book-tile{display:grid;grid-template-columns:110px 1fr}.book-cover{height:100%;min-height:135px}.book-tile-info{padding:12px}.book-showcase-head{align-items:flex-start}}
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="brand">
            <span class="brand-icon">📚</span>
            <span>PustakaSAW</span>
        </div>
        <p class="brand-sub">Sistem Informasi Perpustakaan</p>
        <nav>
            <div class="label">MENU UTAMA</div>
            <a class="nav active" href="{{ route('dashboard') }}">▦ Dashboard</a>
            <a class="nav" href="{{ route('buku.index') }}">📚 Data Buku</a>
            <a class="nav" href="{{ route('anggota.index') }}">👥 Data Anggota</a>
            <a class="nav" href="{{ route('peminjaman.index') }}">📋 Data Peminjaman</a>
            <div class="label">METODE SAW</div>
            <a class="nav" href="{{ route('kriteria.index') }}">⚙️ Data Kriteria</a>
            <a class="nav" href="{{ route('penilaian.index') }}">📝 Data Penilaian</a>
            <a class="nav" href="{{ route('hasil-saw.index') }}">🏆 Hasil Perangkingan SAW</a>
        </nav>
    </aside>

    <main class="main">
        <header class="topbar">
            <div>
                <h1>Dashboard</h1>
                <p class="muted">Selamat datang di sistem informasi perpustakaan PustakaSAW.</p>
            </div>
            <div class="top-actions">
                <button class="theme-btn" id="themeToggle" type="button">
                    <span id="themeIcon">🌙</span>
                    <span id="themeText">Mode Gelap</span>
                </button>
                <div class="profile">
                    <div class="avatar">PS</div>
                    <div>
                        <strong>Administrator</strong>
                        <small>Pengelola Perpustakaan</small>
                    </div>
                </div>
            </div>
        </header>

        <!-- BANNER GAMBAR PERPUSTAKAAN -->
        <section class="book-hero">
            <div class="book-hero-content">
                <span class="hero-label">📚 Selamat Datang di PustakaSAW</span>
                <h2>Temukan Inspirasi<br>di Setiap Halaman</h2>
                <p>Kelola koleksi buku, anggota, dan peminjaman dengan lebih mudah. Pantau juga hasil penilaian anggota menggunakan metode Simple Additive Weighting (SAW).</p>
                <a class="hero-link" href="{{ route('buku.index') }}">Jelajahi Data Buku <span>→</span></a>
            </div>
        </section>

        <!-- GALERI GAMBAR BUKU -->
        <section class="book-showcase">
            <div class="book-showcase-head">
                <div>
                    <h2>📖 Sudut Literasi</h2>
                    <p class="muted">Inspirasi koleksi dan suasana membaca di perpustakaan.</p>
                </div>
                <a class="muted" href="{{ route('buku.index') }}">Buka Data Buku →</a>
            </div>

            <div class="book-gallery">
                <a class="book-tile" href="{{ route('buku.index') }}">
                    <img class="book-cover"
                         src="https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=800&q=85"
                         alt="Buku terbuka untuk dibaca"
                         loading="lazy"
                         onerror="this.onerror=null;this.src='https://placehold.co/800x500/e9e7ff/5148b8?text=Koleksi+Buku';">
                    <div class="book-tile-info">
                        <strong>Jendela Pengetahuan</strong>
                        <p>Beragam bacaan untuk menambah wawasan dan ide baru.</p>
                        <span class="book-tag">KOLEKSI BUKU</span>
                    </div>
                </a>

                <a class="book-tile" href="{{ route('buku.index') }}">
                    <img class="book-cover"
                         src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=800&q=85"
                         alt="Tumpukan buku berwarna"
                         loading="lazy"
                         onerror="this.onerror=null;this.src='https://placehold.co/800x500/e4f5ed/167653?text=Buku+Pendidikan';">
                    <div class="book-tile-info">
                        <strong>Ruang Belajar</strong>
                        <p>Buku sebagai teman belajar, berkarya, dan berkembang.</p>
                        <span class="book-tag">PENDIDIKAN</span>
                    </div>
                </a>

                <a class="book-tile" href="{{ route('buku.index') }}">
                    <img class="book-cover"
                         src="https://images.unsplash.com/photo-1495446815901-a7297e633e8d?auto=format&fit=crop&w=800&q=85"
                         alt="Rak dan koleksi buku"
                         loading="lazy"
                         onerror="this.onerror=null;this.src='https://placehold.co/800x500/fff0df/a85a12?text=Referensi';">
                    <div class="book-tile-info">
                        <strong>Sudut Referensi</strong>
                        <p>Temukan bacaan yang mendukung kebutuhan informasi.</p>
                        <span class="book-tag">REFERENSI</span>
                    </div>
                </a>
            </div>
        </section>

        <!-- KARTU STATISTIK -->
        <section class="stats">
            <a class="card" href="{{ route('buku.index') }}">
                <div class="stat-top">
                    <span class="stat-title">Total Buku</span>
                    <span class="stat-icon">📚</span>
                </div>
                <div class="stat-number">{{ $totalBuku ?? 0 }}</div>
                <div class="muted">Koleksi buku terdaftar</div>
            </a>

            <a class="card" href="{{ route('anggota.index') }}">
                <div class="stat-top">
                    <span class="stat-title">Total Anggota</span>
                    <span class="stat-icon blue">👥</span>
                </div>
                <div class="stat-number">{{ $totalAnggota ?? 0 }}</div>
                <div class="muted">Anggota perpustakaan</div>
            </a>

            <a class="card" href="{{ route('peminjaman.index') }}">
                <div class="stat-top">
                    <span class="stat-title">Total Peminjaman</span>
                    <span class="stat-icon pink">📋</span>
                </div>
                <div class="stat-number">{{ $totalPeminjaman ?? 0 }}</div>
                <div class="muted">Transaksi tercatat</div>
            </a>

            <a class="card" href="{{ route('peminjaman.index') }}">
                <div class="stat-top">
                    <span class="stat-title">Peminjaman Aktif</span>
                    <span class="stat-icon green">📖</span>
                </div>
                <div class="stat-number">{{ $peminjamanAktif ?? 0 }}</div>
                <div class="muted">Buku belum dikembalikan</div>
            </a>

            <a class="card" href="{{ route('kriteria.index') }}">
                <div class="stat-top">
                    <span class="stat-title">Total Kriteria</span>
                    <span class="stat-icon orange">⚙️</span>
                </div>
                <div class="stat-number">{{ $totalKriteria ?? 0 }}</div>
                <div class="muted">Kriteria perhitungan SAW</div>
            </a>

            <a class="card" href="{{ route('hasil-saw.index') }}">
                <div class="stat-top">
                    <span class="stat-title">Hasil SAW</span>
                    <span class="stat-icon">🏆</span>
                </div>
                <div class="stat-number">{{ $totalHasilSAW ?? 0 }}</div>
                <div class="muted">Hasil perangkingan</div>
            </a>
        </section>

        <!-- AKSES CEPAT -->
        <section class="section">
            <div class="section-head">
                <h2>Akses Cepat</h2>
                <span class="muted">Pilih menu untuk membuka halaman</span>
            </div>
            <div class="quick">
                <a class="card quick-link" href="{{ route('buku.index') }}">
                    <span class="stat-icon">📚</span>
                    <span>
                        <strong>Data Buku</strong>
                        <small>Kelola koleksi buku</small>
                    </span>
                </a>
                <a class="card quick-link" href="{{ route('anggota.index') }}">
                    <span class="stat-icon blue">👥</span>
                    <span>
                        <strong>Data Anggota</strong>
                        <small>Kelola data anggota</small>
                    </span>
                </a>
                <a class="card quick-link" href="{{ route('peminjaman.index') }}">
                    <span class="stat-icon pink">📋</span>
                    <span>
                        <strong>Peminjaman</strong>
                        <small>Kelola transaksi buku</small>
                    </span>
                </a>
                <a class="card quick-link" href="{{ route('kriteria.index') }}">
                    <span class="stat-icon orange">⚙️</span>
                    <span>
                        <strong>Data Kriteria</strong>
                        <small>Atur bobot dan jenis</small>
                    </span>
                </a>
                <a class="card quick-link" href="{{ route('penilaian.index') }}">
                    <span class="stat-icon green">📝</span>
                    <span>
                        <strong>Data Penilaian</strong>
                        <small>Isi nilai setiap anggota</small>
                    </span>
                </a>
                <a class="card quick-link" href="{{ route('hasil-saw.index') }}">
                    <span class="stat-icon">🏆</span>
                    <span>
                        <strong>Hasil Perangkingan</strong>
                        <small>Lihat hasil perhitungan SAW</small>
                    </span>
                </a>
            </div>
        </section>

        <!-- GRAFIK PEMINJAMAN DAN KALENDER -->
        <section class="charts">
            <div class="card">
                <h3>📊 Grafik Peminjaman</h3>
                <p class="muted">Jumlah transaksi selama enam bulan terakhir.</p>
                <div class="chart-box">
                    <canvas id="grafikPeminjaman"></canvas>
                </div>
            </div>

            <div class="card">
                <h3>🗓️ Kalender Aktivitas</h3>
                <p class="muted">Pilih bulan untuk melihat tanggal.</p>
                <div class="calendar-head">
                    <button type="button" id="prevMonth">‹</button>
                    <strong id="monthTitle"></strong>
                    <button type="button" id="nextMonth">›</button>
                </div>
                <div class="calendar" id="calendar"></div>
            </div>
        </section>

        <!-- GRAFIK PERANGKINGAN SAW -->
        <section class="section">
            <div class="card">
                <h3>🏆 Grafik Perangkingan Anggota SAW</h3>
                <p class="muted">
                    Perbandingan nilai akhir anggota berdasarkan metode
                    Simple Additive Weighting.
                </p>
                <div class="chart-box ranking">
                    <canvas id="grafikPeringkatSAW"></canvas>
                </div>
                @if(empty($peringkatSAW) || count($peringkatSAW) === 0)
                    <p class="empty">
                        Belum ada hasil perangkingan.
                        Silakan isi penilaian dan lakukan perhitungan SAW terlebih dahulu.
                    </p>
                @endif
            </div>
        </section>

        <!-- TREN DAN RINGKASAN -->
        <section class="lower">
            <div class="card">
                <h3>📈 Tren Peminjaman</h3>
                <p class="muted">Aktivitas bulanan dari database.</p>
                <div class="chart-box">
                    <canvas id="grafikTren"></canvas>
                </div>
            </div>

            <div class="card">
                <h3>🎯 Ringkasan Statistik</h3>
                <p class="muted">Data perpustakaan saat ini.</p>

                <div class="circle-row">
                    <div class="circle" style="--c:#4285ed">
                        <span>{{ $totalBuku ?? 0 }}</span>
                    </div>
                    <div>
                        <strong>Total Koleksi Buku</strong>
                        <small>Buku terdaftar</small>
                    </div>
                </div>

                <div class="circle-row">
                    <div class="circle" style="--c:#20ad79">
                        <span>{{ $totalAnggota ?? 0 }}</span>
                    </div>
                    <div>
                        <strong>Total Anggota</strong>
                        <small>Anggota terdaftar</small>
                    </div>
                </div>

                <div class="circle-row">
                    <div class="circle" style="--c:#ed7184">
                        <span>{{ $peminjamanAktif ?? 0 }}</span>
                    </div>
                    <div>
                        <strong>Peminjaman Aktif</strong>
                        <small>Transaksi belum selesai</small>
                    </div>
                </div>

                <div class="circle-row">
                    <div class="circle" style="--c:#9270ef">
                        <span>{{ $totalHasilSAW ?? 0 }}</span>
                    </div>
                    <div>
                        <strong>Hasil SAW</strong>
                        <small>Hasil tersimpan</small>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>🧩 Komposisi Data</h3>
                <p class="muted">Perbandingan data utama perpustakaan.</p>
                <div class="chart-box">
                    <canvas id="grafikDonat"></canvas>
                </div>
            </div>

            <div class="card">
                <h3>💡 Panduan Penggunaan</h3>
                <p class="muted">Urutan pengelolaan perpustakaan.</p>
                <div class="guide">01 — Lengkapi data buku dan anggota.</div>
                <div class="guide">02 — Catat transaksi peminjaman.</div>
                <div class="guide">03 — Atur kriteria dengan total bobot 1,00.</div>
                <div class="guide">04 — Isi nilai setiap anggota dan kriteria.</div>
                <div class="guide">05 — Hitung SAW untuk menampilkan peringkat.</div>
            </div>
        </section>

        <!-- TABEL DATA TERBARU -->
        <section class="lower">
            <div class="card">
                <div class="section-head">
                    <h2>📋 Peminjaman Terbaru</h2>
                    <a class="muted" href="{{ route('peminjaman.index') }}">Lihat semua →</a>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($peminjamanTerbaru ?? collect()) as $peminjaman)
                                <tr>
                                    <td>{{ $peminjaman->anggota->nama_anggota ?? '-' }}</td>
                                    <td>{{ $peminjaman->buku->judul_buku ?? '-' }}</td>
                                    <td>
                                        <span class="status">
                                            {{ $peminjaman->status ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="empty">
                                        Belum ada transaksi peminjaman.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="section-head">
                    <h2>🏆 Peringkat Anggota SAW</h2>
                    <a class="muted" href="{{ route('hasil-saw.index') }}">Lihat hasil →</a>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Nama Anggota</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($peringkatSAW ?? collect()) as $hasil)
                                <tr>
                                    <td>
                                        <span class="rank">
                                            {{ $hasil->peringkat ?? '-' }}
                                        </span>
                                    </td>
                                    <td>{{ $hasil->anggota->nama_anggota ?? '-' }}</td>
                                    <td>
                                        {{ number_format((float) $hasil->nilai_akhir, 4, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="empty">
                                        Belum ada hasil SAW.<br>
                                        Lengkapi kriteria dan penilaian terlebih dahulu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <footer>
            © {{ date('Y') }} PustakaSAW · Sistem Informasi Perpustakaan dengan Metode SAW
        </footer>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const themeButton = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const themeText = document.getElementById('themeText');

    function setTheme(dark) {
        document.body.classList.toggle('dark', dark);
        themeIcon.textContent = dark ? '☀️' : '🌙';
        themeText.textContent = dark ? 'Mode Terang' : 'Mode Gelap';

        try {
            localStorage.setItem('pustakasaw-theme', dark ? 'dark' : 'light');
        } catch (e) {}

        if (typeof Chart !== 'undefined') {
            Object.values(Chart.instances).forEach(chart => {
                chart.options.color = dark ? '#a4b1ca' : '#8190aa';

                if (chart.options.scales) {
                    Object.values(chart.options.scales).forEach(scale => {
                        if (scale.ticks) {
                            scale.ticks.color = dark ? '#a4b1ca' : '#8190aa';
                        }
                        if (scale.grid) {
                            scale.grid.color = dark ? '#303c55' : '#edf1f7';
                        }
                    });
                }

                chart.update();
            });
        }
    }

    let initialTheme = 'light';

    try {
        initialTheme = localStorage.getItem('pustakasaw-theme') || 'light';
    } catch (e) {}

    setTheme(initialTheme === 'dark');

    themeButton.addEventListener('click', function () {
        setTheme(!document.body.classList.contains('dark'));
    });

    const labels = @json($labelGrafik ?? []);
    const values = @json($dataGrafik ?? []);

    const rankLabels = @json(
        ($peringkatSAW ?? collect())
            ->map(fn ($hasil) => $hasil->anggota->nama_anggota ?? '-')
            ->values()
    );

    const rankValues = @json(
        ($peringkatSAW ?? collect())
            ->map(fn ($hasil) => round((float) $hasil->nilai_akhir, 4))
            ->values()
    );

    const rankNumbers = @json(
        ($peringkatSAW ?? collect())
            ->map(fn ($hasil) => $hasil->peringkat ?? '-')
            ->values()
    );

    const dark = () => document.body.classList.contains('dark');
    const gridColor = () => dark() ? '#303c55' : '#edf1f7';
    const textColor = () => dark() ? '#a4b1ca' : '#8190aa';

    if (typeof Chart !== 'undefined') {
        Chart.defaults.font.family = "'Segoe UI', Arial, sans-serif";
        Chart.defaults.color = textColor();

        const axes = () => ({
            x: {
                grid: { color: gridColor() },
                ticks: { color: textColor() }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0,
                    color: textColor()
                },
                grid: { color: gridColor() }
            }
        });

        new Chart(document.getElementById('grafikPeminjaman'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Peminjaman',
                    data: values,
                    backgroundColor: '#625cf0',
                    borderRadius: 7,
                    maxBarThickness: 36
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: axes(),
                plugins: {
                    legend: { display: false }
                }
            }
        });

        new Chart(document.getElementById('grafikTren'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Peminjaman',
                    data: values,
                    borderColor: '#ed7184',
                    backgroundColor: '#ed7184',
                    tension: 0.35,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: axes(),
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
        });

        const rankingCanvas = document.getElementById('grafikPeringkatSAW');

        if (rankLabels.length > 0) {
            new Chart(rankingCanvas, {
                type: 'bar',
                data: {
                    labels: rankLabels,
                    datasets: [{
                        label: 'Nilai Akhir SAW',
                        data: rankValues,
                        backgroundColor: rankValues.map((value, index) => {
                            if (Number(rankNumbers[index]) === 1) return '#f5b82e';
                            if (Number(rankNumbers[index]) === 2) return '#8c96a8';
                            if (Number(rankNumbers[index]) === 3) return '#cd8b59';
                            return '#625cf0';
                        }),
                        borderRadius: 6,
                        maxBarThickness: 24
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            max: 1,
                            ticks: {
                                color: textColor(),
                                stepSize: 0.2
                            },
                            grid: {
                                color: gridColor()
                            },
                            title: {
                                display: true,
                                text: 'Nilai Akhir SAW',
                                color: textColor()
                            }
                        },
                        y: {
                            ticks: {
                                color: textColor(),
                                autoSkip: false
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const index = context.dataIndex;
                                    return 'Peringkat ' + rankNumbers[index]
                                        + ' — Nilai: '
                                        + Number(context.raw).toFixed(4);
                                }
                            }
                        }
                    }
                }
            });
        } else {
            rankingCanvas.parentElement.innerHTML =
                '<p class="empty">Belum ada data untuk grafik SAW. Isi penilaian dan hitung SAW terlebih dahulu.</p>';
        }

        new Chart(document.getElementById('grafikDonat'), {
            type: 'doughnut',
            data: {
                labels: ['Buku', 'Anggota', 'Peminjaman'],
                datasets: [{
                    data: [
                        {{ $totalBuku ?? 0 }},
                        {{ $totalAnggota ?? 0 }},
                        {{ $totalPeminjaman ?? 0 }}
                    ],
                    backgroundColor: ['#4285ed', '#ed7184', '#20ad79'],
                    borderColor: dark() ? '#1b2639' : '#ffffff',
                    borderWidth: 3,
                    hoverOffset: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: textColor()
                        }
                    }
                }
            }
        });
    } else {
        document.querySelectorAll('.chart-box').forEach(function (element) {
            element.innerHTML =
                '<p class="muted">Grafik tidak dapat dimuat. Periksa koneksi internet lalu muat ulang halaman.</p>';
        });
    }

    const calendar = document.getElementById('calendar');
    const monthTitle = document.getElementById('monthTitle');
    let monthDate = new Date();
    const today = new Date();

    function renderCalendar() {
        const year = monthDate.getFullYear();
        const month = monthDate.getMonth();

        monthTitle.textContent = monthDate.toLocaleDateString('id-ID', {
            month: 'long',
            year: 'numeric'
        });

        calendar.innerHTML = '';

        ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'].forEach(function (day) {
            const cell = document.createElement('div');
            cell.className = 'weekday';
            cell.textContent = day;
            calendar.appendChild(cell);
        });

        const firstDay = new Date(year, month, 1).getDay();

        for (let i = 0; i < firstDay; i++) {
            calendar.appendChild(document.createElement('div'));
        }

        const lastDay = new Date(year, month + 1, 0).getDate();

        for (let day = 1; day <= lastDay; day++) {
            const cell = document.createElement('div');
            cell.textContent = day;

            if (
                day === today.getDate() &&
                month === today.getMonth() &&
                year === today.getFullYear()
            ) {
                cell.className = 'today';
            } else if (day === 1) {
                cell.className = 'first';
            }

            calendar.appendChild(cell);
        }
    }

    document.getElementById('prevMonth').addEventListener('click', function () {
        monthDate.setMonth(monthDate.getMonth() - 1);
        renderCalendar();
    });

    document.getElementById('nextMonth').addEventListener('click', function () {
        monthDate.setMonth(monthDate.getMonth() + 1);
        renderCalendar();
    });

    renderCalendar();
});
</script>
</body>
</html>