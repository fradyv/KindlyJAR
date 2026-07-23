<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gabung Jadi Hero · KindlyJAR</title>
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
        <a href="{{ route('inisiasi') }}" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M18 11V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0"/>
            <path d="M14 10V4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v2"/>
            <path d="M10 10.5V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v8"/>
            <path d="M18 8a2 2 0 1 1 4 0v6a8 8 0 0 1-8 8h-2c-2.8 0-4.5-.86-5.99-2.34l-3.6-3.6a2 2 0 0 1 2.83-2.82L7 15"/>
          </svg>
          Inisiasi Donasi
        </a>
      </nav>
    </div>
  </aside>

  <!-- ── KANAN: topbar (tidak scroll) + konten (scroll) ── -->
  <div class="dash-right">

    <div class="dash-topbar">
      <h1 class="dash-greeting">Gabung Jadi Hero</h1>
      <div class="dash-topbar-right">
        <div class="notif-wrap">
          <button class="notif-btn" id="cartBtn" aria-label="Keranjang">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
              <line x1="3" y1="6" x2="21" y2="6"/>
              <path d="M16 10a4 4 0 01-8 0"/>
            </svg>
          </button>
          @include('partials.cart-dropdown')
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
            <img src="{{ asset('assets/pp dahsboard.jpg') }}" alt="{{ auth()->user()->display_name }}" class="dash-avatar" />
            <div>
              <p class="dash-profile-name" id="dashProfileName">{{ auth()->user()->display_name }}</p>
              <p class="dash-profile-email" id="dashProfileEmail">{{ auth()->user()->email }}</p>
            </div>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#b0b7c3" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left:4px;flex-shrink:0">
              <polyline points="6 9 12 15 18 9"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <main class="dash-scroll">
      <div class="dash-main-card">

        <div id="heroFormWrap">

          <!-- ── 1. HERO SECTION ── -->
          <div class="dash-section inisiasi-hero">
            <div class="inisiasi-hero-bg">
              <img src="{{ asset('assets/photo baru.jpg') }}" alt="" />
            </div>
            <h2 class="inisiasi-hero-title">Mulai Berjualan, Jadi Hero di KindlyJAR</h2>
            <p class="inisiasi-hero-sub">Buka tokomu sendiri dan jual produk seluruh hasil penjualan akan tersalurkan langsung untuk program kebaikan. Gabung sekarang, gratis!</p>
            <a href="#formPendaftaranToko" class="btn-hero inisiasi-cta-btn">Isi Form Pendaftaran</a>
          </div>

          <!-- ── 2. KENAPA HARUS JADI HERO ── -->
          <div class="dash-section">
            <h3 class="dash-card-title">Kenapa Harus Jadi Hero?</h3>
            <div class="inisiasi-why-grid">
              <div class="inisiasi-why-card">
                <span class="inisiasi-why-icon">🛒</span>
                <h4>Buka Toko Sendiri</h4>
                <p>Jual produk apapun yang mendukung program kebaikan.</p>
              </div>
              <div class="inisiasi-why-card">
                <span class="inisiasi-why-icon">📦</span>
                <h4>Kelola Pesanan dengan Mudah</h4>
                <p>Pantau pesanan masuk langsung dari dashboard.</p>
              </div>
              <div class="inisiasi-why-card">
                <span class="inisiasi-why-icon">❤️</span>
                <h4>100% Hasil Penjualan Tersalurkan</h4>
                <p>Semua dana dari produk yang terjual langsung masuk ke program donasi, bukan keuntungan pribadi.</p>
              </div>
              <div class="inisiasi-why-card">
                <span class="inisiasi-why-icon">✅</span>
                <h4>Proses Cepat</h4>
                <p>Gak perlu verifikasi ribet, langsung isi data toko.</p>
              </div>
            </div>
          </div>

          <!-- ── 3 & 4. FORM PENDAFTARAN TOKO + TOMBOL AKSI ── -->
          <div class="dash-section" id="formPendaftaranToko">
            <h3 class="dash-card-title">Form Pendaftaran Toko</h3>
            <p class="dash-card-sub">Lengkapi data toko kamu, prosesnya cepat kok.</p>

            @if ($errors->any())
              <div class="verification-banner" style="background:#fef2f2;border-color:#fecaca;margin-bottom:16px;">
                <div class="banner-content">
                  <span class="banner-icon">⚠️</span>
                  <p>{{ $errors->first() }}</p>
                </div>
              </div>
            @endif

            <form method="POST" action="{{ route('gabung-hero.store') }}" autocomplete="off">
              @csrf
              <div class="form-group">
                <label class="form-label">Nama Toko</label>
                <input type="text" name="name" class="form-input-style" placeholder="Contoh: Kriya Kebaikan" value="{{ old('name') }}" required />
              </div>
              <div class="form-group">
                <label class="form-label">Deskripsi Toko</label>
                <textarea name="description" class="form-input-style" rows="3" placeholder="Ceritain toko kamu jual apa..." required>{{ old('description') }}</textarea>
              </div>
              <div class="form-group">
                <label class="form-label">Kategori Produk</label>
                <select name="category" class="form-input-style" required>
                  <option value="" disabled selected>Pilih kategori produk...</option>
                  <option value="desain-poster">Desain Poster</option>
                  <option value="ilustrasi-digital">Ilustrasi Digital</option>
                  <option value="desain-web">Desain Web</option>
                  <option value="aset-3d">Aset 3D</option>
                  <option value="desain-logo">Desain Logo</option>
                  <option value="stok-foto">Stok Foto</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Nomor HP/WhatsApp</label>
                <input type="tel" name="phone" class="form-input-style" id="tokoHpInput" placeholder="Contoh: 081234567xxx" inputmode="numeric" pattern="[0-9]{9,15}" title="Isi hanya dengan angka, 9-15 digit" maxlength="15" value="{{ old('phone') }}" required />
                <span class="form-hint">Dipakai pembeli untuk menghubungi kamu soal pesanan.</span>
              </div>

              <label class="donasi-checkbox-row">
                <input type="checkbox" id="tokoSetujuInput" required />
                Saya setuju dengan Syarat & Ketentuan Hero
              </label>

              <div class="form-action-footer">
                <a href="{{ route('kindlyshop') }}" class="btn-form-back">Batal, kembali ke KindlyShop</a>
                <button type="submit" class="btn-form-next">Daftar Jadi Hero</button>
              </div>
            </form>
          </div>

        </div><!-- /#heroFormWrap -->

      </div><!-- /.dash-main-card -->
    </main>

    <!-- Dropdowns -->
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
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="profile-menu-item danger" style="border:none;background:none;width:100%;text-align:left;cursor:pointer;font:inherit;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
              <polyline points="16 17 21 12 16 7"/>
              <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Keluar
          </button>
        </form>
      </div>
    </div>

  </div><!-- .dash-right -->

  <script src="{{ asset('global/script.js') }}"></script>
  @include('partials.dash-dropdown-script')
  <script>
    // ── Nomor HP/WhatsApp: cuma boleh angka, huruf/simbol otomatis dibuang ──
    document.getElementById('tokoHpInput').addEventListener('input', (e) => {
      e.target.value = e.target.value.replace(/\D/g, '');
    });
  </script>
</body>
</html>
