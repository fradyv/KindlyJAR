<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Pembelian · KindlyJAR</title>
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
        <a href="{{ route('program-donasi') }}" class="sidebar-link">
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
        <a href="{{ route('riwayat') }}" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
            <polyline points="7 10 12 15 17 10"/>
            <line x1="12" y1="15" x2="12" y2="3"/>
          </svg>
          Riwayat Pembelian
        </a>
        <a href="{{ route('inisiasi') }}" class="sidebar-link active">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M18 11V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0"/>
            <path d="M14 10V4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v2"/>
            <path d="M10 10.5V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v8"/>
            <path d="M18 8a2 2 0 1 1 4 0v6a8 8 0 0 1-8 8h-2c-2.8 0-4.5-.86-5.99-2.34l-3.6-3.6a2 2 0 0 1 2.83-2.82L7 15"/>
          </svg>
          Inisiasi Donasi
        </a>
      </nav>

      <div class="sidebar-cta">
        <button class="btn-join-hero">Gabung menjadi Hero!</button>
      </div>
    </div>
  </aside>

  <!-- ── KANAN: topbar (tidak scroll) + konten (scroll) ── -->
  <div class="dash-right">

    <!-- Topbar: selalu terlihat, tidak ikut scroll -->
    <div class="dash-topbar">
      <h1 class="dash-greeting">
        Giliranmu Membawa Perubahan, <span class="dash-username" id="dashUsername">Joseph Herlambang</span>
      </h1>
      <div class="dash-topbar-right">
        <div class="notif-wrap">
          <button class="notif-btn" id="cartBtn" aria-label="Keranjang">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
              <line x1="3" y1="6" x2="21" y2="6"/>
              <path d="M16 10a4 4 0 01-8 0"/>
            </svg>
          </button>
          <div class="notif-dropdown" id="cartDropdown">
            <div class="notif-header">
              <span class="notif-title">Keranjang</span>
              <span class="notif-badge">0 item</span>
            </div>
            <div class="notif-empty">
              <svg width="36" height="36" fill="none" stroke="#b0b7c3" stroke-width="1.5" viewBox="0 0 24 24">
                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                <line x1="3" y1="6" x2="21" y2="6"/>
                <path d="M16 10a4 4 0 01-8 0"/>
              </svg>
              <p>Keranjang masih kosong</p>
            </div>
          </div>
        </div>
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
        <!-- ── HEADLINE AJUKAN FORM ── -->
<div style="margin-bottom: 28px;">
  <h2 class="dash-card-title" style="font-size: 1.5rem;">Formulir Pengajuan Penggalang Dana</h2>
  <p class="dash-card-sub">Lengkapi data verifikasi identitas Anda untuk dapat membuat program penggalangan dana secara valid.</p>
</div>

<!-- ── COMPONENT: TRACK BAR PROGRES KATEGORI (25% - 100%) ── -->
<div class="form-progress-container">
  <div class="form-steps-track">
    <div class="form-progress-bar-fill" id="progressBarFill"></div>
    <div class="step-node active" id="node1">1</div>
    <div class="step-node" id="node2">2</div>
    <div class="step-node" id="node3">3</div>
    <div class="step-node" id="node4">4</div>
  </div>
  <div class="step-labels-row">
    <div class="step-label-text active" id="labelText1">Info Dasar</div>
    <div class="step-label-text" id="labelText2">Identitas</div>
    <div class="step-label-text" id="labelText3">Pencairan</div>
    <div class="step-label-text" id="labelText4">Dokumen</div>
  </div>
</div>

<!-- ── MAIN FORM BLOCK ── -->
<form id="verificationForm" autocomplete="off">
  
  <!-- BAGIAN 1 — INFORMASI DASAR (25%) -->
  <div class="verify-step-panel active" id="stepPanel1">
    <div class="form-grid-2">
      <div class="form-group">
        <label class="form-label">Jenis Akun</label>
        <select class="form-input-style" required>
          <option value="" disabled selected>Pilih jenis akun...</option>
          <option value="individu">Individu</option>
          <option value="yayasan">Yayasan</option>
          <option value="yayasan">Organisasi Mahasiswa</option>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label">Nama Lengkap / Organisasi</label>
        <input type="text" class="form-input-style" placeholder="Sesuai KTP / Nama Resmi Organisasi" required />
      </div>
      <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" class="form-input-style" placeholder="contoh@domain.com" required />
      </div>
      <div class="form-group">
        <label class="form-label">Alamat Lengkap</label>
        <input type="text" class="form-input-style" placeholder="Jalan, No. Rumah, RT/RW, Kecamatan" required />
      </div>
    </div>
  </div>

  <!-- BAGIAN 2 — IDENTITAS PEMEGANG AKUN (50%) -->
  <div class="verify-step-panel" id="stepPanel2">
    <div class="form-grid-2">
      <div class="form-group">
        <label class="form-label">Nomor HP (WhatsApp) Aktif</label>
        <input type="tel" class="form-input-style" placeholder="Contoh: 081234567xxx" required />
      </div>
      <div class="form-group">
        <label class="form-label">Nomor KIK / KTP</label>
        <input type="text" class="form-input-style" placeholder="16 Digit Nomor Induk Kependudukan" required />
      </div>
      
      <!-- Upload Dropzones -->
      <div class="form-group">
        <label class="form-label">Upload Foto KTP</label>
        <div class="custom-file-upload">
          <span class="upload-icon-style">🪪</span>
          <span class="upload-text-main">Pilih file Foto KTP</span>
          <span class="upload-text-sub">Format: JPG, PNG max 5MB</span>
          <input type="file" accept="image/*" required />
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Upload Foto Selfie dengan KTP</label>
        <div class="custom-file-upload">
          <span class="upload-icon-style">📸</span>
          <span class="upload-text-main">Ambil / Pilih Foto Selfie</span>
          <span class="upload-text-sub">Pastikan KTP terbaca jelas</span>
          <input type="file" accept="image/*" required />
        </div>
      </div>
      <div class="form-group full-width">
        <label class="form-label">Upload Foto Profil <span style="color: #b0b7c3; font-weight: 500;">(Opsional)</span></label>
        <div class="custom-file-upload">
          <span class="upload-icon-style">👤</span>
          <span class="upload-text-main">Pilih Foto Profil Anda</span>
          <span class="upload-text-sub">Rasio Disarankan 1:1</span>
          <input type="file" accept="image/*" />
        </div>
      </div>
    </div>
  </div>

  <!-- BAGIAN 3 — INFORMASI PENCAIRAN DANA (75%) -->
  <div class="verify-step-panel" id="stepPanel3">
    <div class="form-grid-2">
      <div class="form-group">
        <label class="form-label">Pilih Bank</label>
        <select class="form-input-style" required>
          <option value="" disabled selected>Pilih Rekening Bank Utama...</option>
          <option value="bca">Bank Central Asia (BCA)</option>
          <option value="bri">Bank Rakyat Indonesia (BRI)</option>
          <option value="mandiri">Bank Mandiri</option>
          <option value="bni">Bank Negara Indonesia (BNI)</option>
          <option value="bsi">Bank Syariah Indonesia (BSI)</option>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label">Nomor Rekening Bank</label>
        <input type="text" class="form-input-style" placeholder="Masukkan nomor rekening tanpa spasi" required />
      </div>
      <div class="form-group">
        <label class="form-label">Nama Pemilik Rekening</label>
        <input type="text" class="form-input-style" placeholder="Harus sesuai dengan nama pemilik buku tabungan" required />
      </div>
      <div class="form-group">
        <label class="form-label">Upload Scan/Foto Buku Tabungan</label>
        <div class="custom-file-upload">
          <span class="upload-text-main">Unggah Foto Halaman Depan Buku Tabungan</span>
          <span class="upload-text-sub">Menampilkan Nama & No Rekening</span>
          <input type="file" accept="image/*" required />
        </div>
      </div>
    </div>
  </div>

  <!-- BAGIAN 4 — DOKUMEN PELENGKAP (100%) -->
  <div class="verify-step-panel" id="stepPanel4">
    <div class="form-grid-2">
      <div class="form-group">
        <label class="form-label">Upload Surat Pernyataan</label>
        <div style="margin-bottom: 8px;">
          <a href="#" class="template-download-link">
            <span>📥</span> Download Template Surat Pernyataan Resmi.docx
          </a>
        </div>
        <div class="custom-file-upload">
          <span class="upload-icon-style">📄</span>
          <span class="upload-text-main">Pilih File Surat Pernyataan</span>
          <span class="upload-text-sub">Format: PDF/JPG hasil tanda tangan</span>
          <input type="file" accept=".pdf, image/*" required />
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Upload Berkas Pendukung <span style="color: #b0b7c3; font-weight: 500;">(Opsional)</span></label>
        <div style="margin-bottom: 8px; height: 18px;"></div> <!-- Spacer alignment -->
        <div class="custom-file-upload">
          <span class="upload-icon-style">📂</span>
          <span class="upload-text-main">Pilih Berkas Legalitas / Sertifikat</span>
          <span class="upload-text-sub">Format: PDF/ZIP jika ada</span>
          <input type="file" accept=".pdf, .zip, .rar, image/*" />
        </div>
      </div>
      
      <!-- OTP Area -->
      <div class="form-group full-width" style="margin-top: 10px;">
        <label class="form-label">Kode Verifikasi OTP</label>
        <div class="otp-input-group">
          <input type="text" class="form-input-style" maxlength="6" placeholder="Masukkan 6 digit kode" style="flex: 1; letter-spacing: 4px; text-align: center; font-weight: 700;" required />
          <button type="button" class="btn-request-otp" id="btnReqOtp">Minta OTP</button>
        </div>
      </div>
    </div>
  </div>

  <!-- FORM NAVIGASI BAWAH -->
  <div class="form-action-footer">
    <button type="button" class="btn-form-back" id="btnFormBack" style="visibility: hidden;">Kembali</button>
    <button type="button" class="btn-form-next" id="btnFormNext">Lanjut</button>
  </div>
</form>
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
</body>
</html>