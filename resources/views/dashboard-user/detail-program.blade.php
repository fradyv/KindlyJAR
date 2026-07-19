<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Program Donasi · KindlyJAR</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('global/style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('global/dashboard.css') }}"/>
</head>
<body class="dashboard-body">

  <!-- ── SIDEBAR ── -->
  <aside class="sidebar">
    <div class="sidebar-top">
      <a class="logo sidebar-logo" href="{{ route('home') }}">
        <div class="logo-icon">
          <img src="{{ asset('assets/logo_putih.png') }}" alt="KindlyJAR" />
        </div>
        <span class="logo-name">KindlyJAR</span>
      </a>

      <p class="sidebar-label">Menu</p>

      <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            <polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
          Beranda
        </a>
        <a href="{{ route('program-donasi') }}" class="sidebar-link active">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
            <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
          </svg>
          Program Donasi
        </a>
        <a href="{{ route('kindlyshop') }}" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
            <line x1="3" y1="6" x2="21" y2="6"/>
            <path d="M16 10a4 4 0 0 1-8 0"/>
          </svg>
          KindlyShop
        </a>
        <a href="#" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
            <polyline points="7 10 12 15 17 10"/>
            <line x1="12" y1="15" x2="12" y2="3"/>
          </svg>
          Riwayat Pembelian
        </a>
        <a href="#" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
          </svg>
          Jejak Kebaikan
        </a>
        <a href="#" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M18 11V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0"/>
            <path d="M14 10V4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v2"/>
            <path d="M10 10.5V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v8"/>
            <path d="M18 8a2 2 0 1 1 4 0v6a8 8 0 0 1-8 8h-2c-2.8 0-4.5-.86-5.99-2.34l-3.6-3.6a2 2 0 0 1 2.83-2.82L7 15"/>
          </svg>
          Inisiasi Donasi
        </a>
        <div class="sidebar-cta">
        <a href="{{ route('gabung-hero') }}" class="btn-join-hero" style="display:inline-block;text-align:center;text-decoration:none;">Gabung menjadi Hero!</a>
      </div>
      </nav>


      <div class="sidebar-hero-menu-wrap" id="sidebarHeroMenu" style="display:none;">
        <p class="sidebar-label">Menu Hero</p>
        <nav class="sidebar-nav">
          <a href="{{ route('toko-saya') }}" class="sidebar-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
              <line x1="3" y1="6" x2="21" y2="6"/>
              <path d="M16 10a4 4 0 0 1-8 0"/>
            </svg>
            Toko Saya
          </a>
          <a href="{{ route('tambah-produk') }}" class="sidebar-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <circle cx="12" cy="12" r="10"/>
              <line x1="12" y1="8" x2="12" y2="16"/>
              <line x1="8" y1="12" x2="16" y2="12"/>
            </svg>
            Tambah Produk
          </a>
          <a href="{{ route('produk-terjual') }}" class="sidebar-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
              <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
              <line x1="12" y1="22.08" x2="12" y2="12"/>
            </svg>
            Produk yang Terjual
          </a>
        </nav>
      </div>
    </div>
  </aside>

  <!-- ── MODAL DONASI & PAYMENT (disamakan dengan dashboard beranda) ── -->
  <div class="modal-overlay" id="donasiModal">
  <div class="modal-box donasi-modal-box">
    <button class="modal-close-btn" id="closeDonasiModal">&times;</button>

    <div class="donasi-modal-header">
      <span class="donasi-modal-badge" id="donasiKategori">Kategori</span>
      <h3 id="donasiJudul">Donasi untuk Program</h3>
    </div>

    <div class="donasi-modal-section">
      <p class="donasi-modal-label">Pilih Nominal</p>
      <div class="donasi-nominal-grid">
        <button type="button" class="donasi-nominal-btn" data-nominal="25000">Rp 25.000</button>
        <button type="button" class="donasi-nominal-btn" data-nominal="50000">Rp 50.000</button>
        <button type="button" class="donasi-nominal-btn" data-nominal="100000">Rp 100.000</button>
        <button type="button" class="donasi-nominal-btn" data-nominal="250000">Rp 250.000</button>
      </div>
      <input type="number" id="donasiNominalCustom" class="donasi-input-custom" placeholder="Atau masukkan nominal lain" min="1000" />
    </div>

    <div class="donasi-modal-section">
      <label class="donasi-checkbox-row">
        <input type="checkbox" id="donasiSembunyikan" />
        Sembunyikan nominal donasi saya
      </label>
      <label class="donasi-checkbox-row">
        <input type="checkbox" id="donasiAnonim" />
        Donasi sebagai anonim / Hamba Allah
      </label>
      <textarea id="donasiUcapan" class="donasi-textarea" placeholder="Tulis doa/ucapan untuk penerima manfaat (opsional)"></textarea>
    </div>

    <div class="donasi-modal-section">
      <p class="donasi-modal-label">Metode Pembayaran</p>
      <div class="donasi-metode-list">
        <label class="donasi-metode-item">
          <input type="radio" name="donasiMetode" value="Transfer Bank" checked />
          <span>🏦 Transfer Bank</span>
        </label>
        <label class="donasi-metode-item">
          <input type="radio" name="donasiMetode" value="E-Wallet" />
          <span>📱 E-Wallet</span>
        </label>
        <label class="donasi-metode-item">
          <input type="radio" name="donasiMetode" value="Kartu Kredit" />
          <span>💳 Kartu Kredit</span>
        </label>
      </div>
    </div>

    <div class="donasi-modal-summary">
      <span>Total Donasi</span>
      <strong id="donasiTotal">Rp 0</strong>
    </div>

    <button class="modal-btn btn-primary donasi-confirm-btn" id="btnKonfirmasiDonasi">Konfirmasi Donasi</button>
  </div>
</div>

    <!-- ── MODAL PAYMENT ── -->
  <div class="modal-overlay" id="paymentModal">
    <div class="modal-box donasi-modal-box">
      <button class="modal-close-btn" id="closePaymentModal">&times;</button>

      <div class="donasi-modal-header">
        <span class="donasi-modal-badge">Pembayaran</span>
        <h3>Selesaikan Donasi Anda</h3>
      </div>

      <div class="donasi-modal-section">
        <p class="donasi-modal-label">Ringkasan</p>
        <div class="donasi-metode-item" style="flex-direction:column;align-items:flex-start;gap:6px;">
          <span><strong id="payProgramNama">Program</strong></span>
          <span style="font-size:.85rem;color:#6b7a8d;">Metode: <strong id="payMetode">-</strong></span>
          <span style="font-size:.85rem;color:#6b7a8d;">Total: <strong id="payTotal" style="color:#21A3FF;">Rp 0</strong></span>
        </div>
      </div>

      <div class="donasi-modal-section">
        <p class="donasi-modal-label">Instruksi Pembayaran</p>
        <div id="payInstruksi" class="donasi-metode-item" style="display:block;line-height:1.55;font-size:.9rem;color:#3D3D4E;">
          Silakan pilih metode pembayaran terlebih dahulu.
        </div>
      </div>

      <button class="modal-btn btn-primary donasi-confirm-btn" id="btnBayarSekarang">Bayar Sekarang</button>
    </div>
  </div>

  <!-- ── KANAN: topbar (tidak scroll) + konten (scroll) ── -->
  <div class="dash-right">

    <!-- Topbar: selalu terlihat, tidak ikut scroll -->
    <div class="dash-topbar">
      <h1 class="dash-greeting">
        Program Donasi · <span class="dash-username" id="dashUsername">Joseph Herlambang</span>
      </h1>
      <div class="dash-topbar-right">
        <div class="notif-wrap">
          <button class="notif-btn" id="notifBtn" aria-label="Notifikasi">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
              <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
          </button>
        </div>
        <div class="profile-wrap">
          <div class="dash-profile" id="profileBtn">
            <img src="{{ asset('assets/pp dahsboard.jpg') }}" alt="Joseph Herlambang" class="dash-avatar" />
            <div>
              <p class="dash-profile-name" id="dashProfileName">Joseph Herlambang</p>
              <p class="dash-profile-email" id="dashProfileEmail">josephbalado@gmail.com</p>
            </div>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#b0b7c3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left:4px;flex-shrink:0">
              <polyline points="6 9 12 15 18 9"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Banner Warning Tetap Muncul -->
    <div class="verification-banner" id="verifyBanner">
      <div class="banner-content">
        <span class="banner-icon">⚠️</span>
        <p><strong>Akun Belum Terverifikasi:</strong> Silakan verifikasi identitasmu terlebih dahulu untuk membuka akses penuh penggalangan dana dan donasi secara aman.</p>
      </div>
      <div class="banner-actions">
        <a href="{{ route('verify') }}" class="banner-btn">Verifikasi Sekarang</a>
        <button class="banner-close" id="closeBannerBtn">&times;</button>
      </div>
    </div>

    <!-- AREA SCROLL BOX UTAMA -->
    <main class="dash-scroll">

      <!-- Satu card besar pembungkus utama konten kosong -->
      <div class="dash-main-card">

        <a href="#" class="detail-back-link" id="btnBackDetail">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"/>
            <polyline points="12 19 5 12 12 5"/>
        </svg>
        Kembali
        </a>

        <!-- 1. HERO BANNER -->
        <div class="detail-hero">
        <img src="{{ asset('assets/program1.jpg') }}" alt="Banner Program" class="detail-hero-img" />
        <div class="detail-hero-overlay">
            <span class="detail-badge">Pendidikan</span>
            <h1 class="detail-judul">Renovasi Laboratorium Komputer SMK TI Papua</h1>
            <p class="detail-penyelenggara">oleh <strong>Yayasan Nusantara Maju</strong></p>
        </div>
        </div>

        <!-- 2. PROGRESS DONASI -->
        <div class="detail-progress-box">
        <div class="detail-progress-bar-wrap">
            <div class="detail-progress-fill" style="width: 63%"></div>
        </div>
        <div class="detail-progress-stats">
            <div>
            <p class="detail-stat-value">Rp 63.000.000</p>
            <p class="detail-stat-label">Terkumpul dari Rp 100.000.000</p>
            </div>
            <div class="detail-stat-right">
            <span class="detail-pct">63%</span>
            </div>
        </div>
        <div class="detail-meta-row">
            <span>👥 128 donatur</span>
            <span>⏳ 12 hari lagi</span>
        </div>
        </div>

        <!-- 3. TOMBOL AKSI (sticky) -->
        <div class="detail-sticky-cta">
        <button class="btn-donasi-besar btn-donasi">Donasi Sekarang</button>
        <div class="detail-share-row">
            <span class="detail-share-label">Bagikan:</span>
            <button class="btn-share">WhatsApp</button>
            <button class="btn-share">Twitter/X</button>
            <button class="btn-share">Salin Link</button>
        </div>
        </div>

        <!-- 4. DESKRIPSI PROGRAM -->
        <div class="detail-section">
        <h2 class="detail-section-title">Latar Belakang</h2>
        <p class="detail-text">SMK TI Papua memiliki 200 siswa jurusan teknologi informasi namun laboratorium komputer mereka sudah tidak layak pakai sejak 2019. Sebagian besar komputer rusak dan tidak bisa diperbaiki...</p>
        </div>

        <div class="detail-section">
        <h2 class="detail-section-title">Tujuan & Dampak</h2>
        <p class="detail-text">Dengan renovasi ini, 200 siswa akan mendapat akses belajar praktik yang layak, meningkatkan kelulusan uji kompetensi nasional, dan membuka peluang kerja di sektor digital.</p>
        </div>

        <!-- 5. RINCIAN PENGGUNAAN DANA -->
        <div class="detail-section">
        <h2 class="detail-section-title">Rencana Penggunaan Dana</h2>
        <div class="detail-dana-list">
            <div class="detail-dana-item">
            <div class="detail-dana-info">
                <span class="detail-dana-label">Perangkat Komputer (20 unit)</span>
                <span class="detail-dana-pct">40%</span>
            </div>
            <div class="detail-dana-bar"><div style="width:40%"></div></div>
            <span class="detail-dana-nominal">Rp 40.000.000</span>
            </div>
            <div class="detail-dana-item">
            <div class="detail-dana-info">
                <span class="detail-dana-label">Renovasi Ruangan</span>
                <span class="detail-dana-pct">30%</span>
            </div>
            <div class="detail-dana-bar"><div style="width:30%"></div></div>
            <span class="detail-dana-nominal">Rp 30.000.000</span>
            </div>
            <div class="detail-dana-item">
            <div class="detail-dana-info">
                <span class="detail-dana-label">Instalasi Jaringan & Listrik</span>
                <span class="detail-dana-pct">20%</span>
            </div>
            <div class="detail-dana-bar"><div style="width:20%"></div></div>
            <span class="detail-dana-nominal">Rp 20.000.000</span>
            </div>
            <div class="detail-dana-item">
            <div class="detail-dana-info">
                <span class="detail-dana-label">Operasional & Administrasi</span>
                <span class="detail-dana-pct">10%</span>
            </div>
            <div class="detail-dana-bar"><div style="width:10%"></div></div>
            <span class="detail-dana-nominal">Rp 10.000.000</span>
            </div>
        </div>
        </div>

        <!-- 6. GALERI -->
        <div class="detail-section">
        <h2 class="detail-section-title">Dokumentasi</h2>
        <div class="detail-galeri">
            <img src="{{ asset('assets/program1.jpg') }}" alt="Foto 1" />
            <img src="{{ asset('assets/program2.jpg') }}" alt="Foto 2" />
            <img src="{{ asset('assets/program3.jpg') }}" alt="Foto 3" />
            <img src="{{ asset('assets/program4.jpg') }}" alt="Foto 4" />
        </div>
        </div>

        <!-- 7. DONATUR TERBARU -->
        <div class="detail-section">
        <h2 class="detail-section-title">Donatur Terbaru</h2>
        <div class="detail-donatur-list">
            <div class="detail-donatur-item">
            <div class="detail-donatur-avatar">A</div>
            <div>
                <p class="detail-donatur-name">Anonim</p>
                <p class="detail-donatur-time">2 jam lalu</p>
            </div>
            <span class="detail-donatur-nominal">Rp 100.000</span>
            </div>
            <div class="detail-donatur-item">
            <div class="detail-donatur-avatar">B</div>
            <div>
                <p class="detail-donatur-name">Budi S.</p>
                <p class="detail-donatur-time">5 jam lalu</p>
            </div>
            <span class="detail-donatur-nominal">Rp 50.000</span>
            </div>
            <div class="detail-donatur-item">
            <div class="detail-donatur-avatar">H</div>
            <div>
                <p class="detail-donatur-name">Hamba Allah</p>
                <p class="detail-donatur-time">1 hari lalu</p>
            </div>
            <span class="detail-donatur-nominal">Rp 500.000</span>
            </div>
        </div>
        </div>

        <!-- 8. UPDATE BERKALA -->
        <div class="detail-section">
        <h2 class="detail-section-title">Update Program</h2>
        <div class="detail-update-list">
            <div class="detail-update-item">
            <div class="detail-update-dot"></div>
            <div>
                <p class="detail-update-date">12 Juni 2026</p>
                <p class="detail-update-text">Dana sudah 50% terkumpul. Tim mulai survei lokasi renovasi.</p>
            </div>
            </div>
            <div class="detail-update-item">
            <div class="detail-update-dot"></div>
            <div>
                <p class="detail-update-date">1 Juni 2026</p>
                <p class="detail-update-text">Program resmi diluncurkan. Terima kasih atas dukungan awal dari 30 donatur pertama!</p>
            </div>
            </div>
        </div>
        </div>

        <!-- 9. PROGRAM SERUPA -->
        <div class="detail-section">
        <h2 class="detail-section-title">Program Serupa</h2>
        <div class="trending-grid">
            <div class="trending-card">
            <div class="trending-img"><img src="{{ asset('assets/program2.jpg') }}" alt="" /></div>
            <div class="trending-body">
                <div class="trending-title">Pengadaan Buku Gambar Sekolah Alam Flores</div>
                <div class="t-progress">
                <div class="t-bar"><div class="t-fill" style="width:87%"></div></div>
                <span class="t-pct">87% Terpenuhi</span>
                </div>
                <button class="btn-t-donasi btn-donasi">Donasi!</button>
            </div>
            </div>
            <div class="trending-card">
            <div class="trending-img"><img src="{{ asset('assets/program3.jpg') }}" alt="" /></div>
            <div class="trending-body">
                <div class="trending-title">Alat Musik Kreatif untuk Difabel Yogyakarta</div>
                <div class="t-progress">
                <div class="t-bar"><div class="t-fill" style="width:63%"></div></div>
                <span class="t-pct">63% Terpenuhi</span>
                </div>
                <button class="btn-t-donasi btn-donasi">Donasi!</button>
            </div>
            </div>
            <div class="trending-card">
            <div class="trending-img"><img src="{{ asset('assets/program4.jpg') }}" alt="" /></div>
            <div class="trending-body">
                <div class="trending-title">Panel Surya Sekolah Pelosok Mentawai</div>
                <div class="t-progress">
                <div class="t-bar"><div class="t-fill" style="width:45%"></div></div>
                <span class="t-pct">45% Terpenuhi</span>
                </div>
                <button class="btn-t-donasi btn-donasi">Donasi!</button>
            </div>
            </div>
        </div>
        </div>

      </div><!-- /.dash-main-card -->
    </main>

    <!-- Dropdowns (Tetap Berfungsi) -->
    <div class="notif-dropdown" id="notifDropdown">
      <div class="notif-header">
        <span class="notif-title">Notifikasi</span>
        <span class="notif-badge">0 baru</span>
      </div>
      <div class="notif-empty">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#b0b7c3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
          <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
        </svg>
        <p>Belum ada notifikasi</p>
      </div>
    </div>

    <div class="profile-dropdown" id="profileDropdown">
      <div class="profile-dropdown-menu">
        <a href="{{ route('profil') }}" class="profile-menu-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
          Lihat Profil
        </a>
        <a href="{{ route('pengaturan-akun') }}" class="profile-menu-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="3"/>
            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
          </svg>
          Pengaturan
        </a>
        <div class="profile-menu-divider"></div>
        <a href="{{ route('home') }}" class="profile-menu-item danger">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
            <polyline points="16 17 21 12 16 7"/>
            <line x1="21" y1="12" x2="9" y2="12"/>
          </svg>
          Keluar
        </a>
      </div>
    </div>

  </div><!-- .dash-right -->

  <script src="{{ asset('global/script.js') }}"></script>
  <script>
    // Logic Dropdown bawaan template agar fungsionalitas topbar tidak rusak
    const notifBtn      = document.getElementById('notifBtn');
    const notifDropdown = document.getElementById('notifDropdown');
    const profileBtn    = document.getElementById('profileBtn');
    const profileDropdown = document.getElementById('profileDropdown');
    const dashRight     = document.querySelector('.dash-right');

    function positionDropdown(dropdown, anchor) {
      const pr = dashRight.getBoundingClientRect();
      const ar = anchor.getBoundingClientRect();
      dropdown.style.top   = (ar.bottom - pr.top + 8) + 'px';
      dropdown.style.right = (pr.right - ar.right) + 'px';
      dropdown.style.left  = 'auto';
    }

    notifBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const opening = !notifDropdown.classList.contains('open');
      profileDropdown.classList.remove('open');
      if (opening) {
        positionDropdown(notifDropdown, notifBtn);
        notifDropdown.classList.add('open');
      } else {
        notifDropdown.classList.remove('open');
      }
    });

    profileBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const opening = !profileDropdown.classList.contains('open');
      notifDropdown.classList.remove('open');
      if (opening) {
        positionDropdown(profileDropdown, profileBtn);
        profileDropdown.classList.add('open');
      } else {
        profileDropdown.classList.remove('open');
      }
    });

    document.addEventListener('click', () => {
      notifDropdown.classList.remove('open');
      profileDropdown.classList.remove('open');
    });

    
  </script>
    <script>
    /* script.js global sudah handle: modal donasi, notif, profile, cart.
       Di sini kita hanya menambahkan flow PAYMENT setelah "Konfirmasi Donasi". */
    document.addEventListener('DOMContentLoaded', () => {
      const paymentModal     = document.getElementById('paymentModal');
      const closePaymentBtn  = document.getElementById('closePaymentModal');
      const payProgramNama   = document.getElementById('payProgramNama');
      const payMetodeEl      = document.getElementById('payMetode');
      const payTotalEl       = document.getElementById('payTotal');
      const payInstruksiEl   = document.getElementById('payInstruksi');
      const btnBayarSekarang = document.getElementById('btnBayarSekarang');
      const btnKonfirmasi    = document.getElementById('btnKonfirmasiDonasi');
      const donasiModal      = document.getElementById('donasiModal');
      const donasiJudulEl    = document.getElementById('donasiJudul');
      const donasiTotalEl    = document.getElementById('donasiTotal');
      if (!paymentModal || !btnKonfirmasi) return;

      const instruksiMap = {
        'Transfer Bank': '🏦 Transfer ke <strong>BCA 1234567890</strong> a.n. KindlyJAR. Gunakan nominal tepat sesuai total di atas.',
        'E-Wallet':      '📱 Scan QRIS via GoPay / OVO / DANA / ShopeePay pada halaman berikutnya.',
        'Kartu Kredit':  '💳 Anda akan diarahkan ke gateway pembayaran kartu yang aman.'
      };

      function openPaymentModal() {
        const metode = document.querySelector('input[name="donasiMetode"]:checked')?.value || 'Transfer Bank';
        payProgramNama.textContent = donasiJudulEl.textContent;
        payMetodeEl.textContent    = metode;
        payTotalEl.textContent     = donasiTotalEl.textContent;
        payInstruksiEl.innerHTML   = instruksiMap[metode] || '';
        paymentModal.classList.add('show');
      }
      function closePaymentModal() { paymentModal.classList.remove('show'); }

      // Intercept sebelum handler script.js jalan (capture phase)
      btnKonfirmasi.addEventListener('click', (e) => {
        const nominal = parseInt((donasiTotalEl.textContent || '').replace(/\D/g, ''), 10) || 0;
        if (nominal < 1000) return; // biarkan handler asli munculin alert
        e.stopImmediatePropagation();
        donasiModal.classList.remove('show');
        setTimeout(openPaymentModal, 220);
      }, true);

      closePaymentBtn.addEventListener('click', closePaymentModal);
      paymentModal.addEventListener('click', (e) => {
        if (e.target === paymentModal) closePaymentModal();
      });
      btnBayarSekarang.addEventListener('click', () => {
        alert('Terima kasih! Pembayaran ' + payTotalEl.textContent + ' via ' + payMetodeEl.textContent + ' sedang diproses.');
        closePaymentModal();
      });
    });
  </script>
</body>
</html>