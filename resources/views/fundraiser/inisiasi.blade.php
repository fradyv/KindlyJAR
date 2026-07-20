<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inisiasi Donasi · KindlyJAR</title>
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
        @unless (auth()->user()->shop)
        <div class="sidebar-cta">
        <a href="{{ route('gabung-hero') }}" class="btn-join-hero" style="display:inline-block;text-align:center;text-decoration:none;">Gabung menjadi Hero!</a>
      </div>
      @endunless
      </nav>


      @if (auth()->user()->shop)
      <div class="sidebar-hero-menu-wrap" id="sidebarHeroMenu">
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
          <a href="{{ route('pencairan-dana') }}" class="sidebar-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <line x1="12" y1="1" x2="12" y2="23"/>
              <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
            </svg>
            Pencairan Dana
          </a>
        </nav>
      </div>
      @endif
    </div>
  </aside>

  <!-- ── KANAN: topbar (tidak scroll) + konten (scroll) ── -->
  <div class="dash-right">

    <!-- Topbar: selalu terlihat, tidak ikut scroll -->
    <div class="dash-topbar">
      <h1 class="dash-greeting">
        Giliranmu Membawa Perubahan, <span class="dash-username" id="dashUsername">{{ auth()->user()->display_name }}</span>
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

    @if (auth()->user()->kyc_status === 'unverified')
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
    @endif

    @if (session('success'))
      <div class="verification-banner" style="background:#ecfdf5;border-color:#a7f3d0;">
        <div class="banner-content">
          <span class="banner-icon">✅</span>
          <p>{{ session('success') }}</p>
        </div>
      </div>
    @endif

    @if (session('error'))
      <div class="verification-banner" style="background:#fef2f2;border-color:#fecaca;">
        <div class="banner-content">
          <span class="banner-icon">⚠️</span>
          <p>{{ session('error') }}</p>
        </div>
      </div>
    @endif

    <!-- AREA SCROLL BOX UTAMA -->
    <main class="dash-scroll">

      <!-- Satu card besar pembungkus utama konten kosong -->
      <div class="dash-main-card">
        <!-- ── HERO SECTION ── -->
      <div class="dash-section inisiasi-hero">
        <div class="inisiasi-hero-bg">
          <img src="{{ asset('assets/inisiasi1.jpg') }}" alt="" />
        </div>
        <h2 class="inisiasi-hero-title">Jadi Penggalang Dana, Wujudkan Pemerataan di Wilayahmu</h2>
        <p class="inisiasi-hero-sub">Ajukan program donasimu dan bantu bangun akses, air bersih, dan ruang tumbuh yang setara bagi mereka yang membutuhkan.</p>
        @if (auth()->user()->kyc_status === 'verified')
          <a href="#buatProgram" class="btn-hero inisiasi-cta-btn" style="display:inline-block;text-decoration:none;">Buat Program Donasi</a>
        @elseif (auth()->user()->kyc_status === 'pending')
          <button class="btn-hero inisiasi-cta-btn" disabled style="opacity:.6;cursor:not-allowed;">Menunggu Verifikasi</button>
        @else
          <button class="btn-hero inisiasi-cta-btn" id="btnMulaiPengajuan">Mulai Pengajuan</button>
        @endif
      </div>

      <!-- ── KENAPA PERLU VERIFIKASI ── -->
      <div class="dash-section">
        <h3 class="dash-card-title">Kenapa Perlu Verifikasi?</h3>
        <div class="inisiasi-why-grid">
          <div class="inisiasi-why-card">
            <h4>Aman & Terpercaya</h4>
            <p>Setiap penggalang dana diverifikasi untuk mencegah penipuan dan menjaga kepercayaan para donatur.</p>
          </div>
          <div class="inisiasi-why-card">
            <h4>Cuma 5 Menit</h4>
            <p>Isi data diri dan dokumen pendukung, prosesnya singkat dan bisa diselesaikan sekali duduk.</p>
          </div>
          <div class="inisiasi-why-card">
            <h4>Ditinjau Admin</h4>
            <p>Setelah submit, tim kami akan meninjau datamu dalam 1–2 hari kerja.</p>
          </div>
          <div class="inisiasi-why-card">
            <h4>Langsung Bisa Galang Dana</h4>
            <p>Begitu terverifikasi, kamu bisa langsung membuat program donasi pertamamu.</p>
          </div>
        </div>
      </div>

      <!-- ── YANG PERLU DISIAPKAN ── -->
      <div class="dash-section">
        <div class="inisiasi-siapkan-row">
          <div class="inisiasi-siapkan-text">
            <h3 class="dash-card-title">Yang Perlu Disiapkan</h3>
            <p class="dash-card-sub">Sebelum mulai, siapkan dokumen berikut ya:</p>
            <ul class="inisiasi-checklist">
          <li>
            <span class="check-icon">✓</span>
            KTP (foto/scan)
          </li>
          <li>
            <span class="check-icon">✓</span>
            Foto selfie dengan KTP
          </li>
          <li>
            <span class="check-icon">✓</span>
            Nomor rekening bank aktif
          </li>
          <li>
            <span class="check-icon">✓</span>
            Nomor WhatsApp aktif
          </li>
        </ul>
      </div>
       <div class="inisiasi-siapkan-img">
      <img src="{{ asset('assets/inisiasi2.jpg') }}" alt="" />
    </div>
  </div>
</div>

      <!-- ── CTA PENUTUP / STATUS BANNER ── -->
      <div class="dash-section" id="inisiasiCtaSection">

        @if (auth()->user()->kyc_status === 'unverified')
        <!-- Default: belum pernah submit -->
        <div id="statusDefault">
          <p class="inisiasi-cta-closing">Siap jadi bagian dari perubahan?</p>
          <button class="btn-hero inisiasi-cta-btn" id="btnMulaiPengajuan2">Mulai Pengajuan Sekarang</button>
        </div>

        @elseif (auth()->user()->kyc_status === 'pending')
        <!-- Status: pending -->
        <div class="inisiasi-status-banner pending">
          <span>🕓</span>
          <div>
            <strong>Pengajuanmu Sedang Ditinjau</strong>
            <p>Tim kami sedang memverifikasi datamu. Kamu akan diberi tahu begitu prosesnya selesai.</p>
          </div>
        </div>

        @elseif (auth()->user()->kyc_status === 'rejected')
        <!-- Status: ditolak -->
        <div class="inisiasi-status-banner ditolak">
          <span>⚠️</span>
          <div>
            <strong>Pengajuan Belum Bisa Disetujui</strong>
            <p>Dokumen yang diunggah belum bisa kami verifikasi. Silakan periksa kembali data dan dokumenmu, lalu ajukan ulang.</p>
            <button class="btn-hero inisiasi-cta-btn" id="btnAjukanUlang">Ajukan Ulang</button>
          </div>
        </div>

        @else
        <!-- Status: verified -->
        <div class="inisiasi-status-banner" style="background:#ecfdf5;border-color:#a7f3d0;">
          <span>✅</span>
          <div>
            <strong>Akunmu Sudah Terverifikasi!</strong>
            <p>Kamu sekarang bisa membuat program donasi sendiri. Isi formulir di bawah untuk mengajukan program baru.</p>
          </div>
        </div>
        @endif

      </div>

      @if (auth()->user()->kyc_status === 'verified')
      <!-- ── BUAT PROGRAM DONASI BARU ── -->
      <div class="dash-section" id="buatProgram">
        <h3 class="dash-card-title">Buat Program Donasi Baru</h3>
        <p class="dash-card-sub">Lengkapi detail program donasimu. Setelah diajukan, program akan langsung tayang di halaman Program Donasi.</p>

        @if ($errors->any())
          <div class="verification-banner" style="background:#fef2f2;border-color:#fecaca;margin-bottom:16px;">
            <div class="banner-content">
              <span class="banner-icon">⚠️</span>
              <ul style="margin:0 0 0 18px;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif

        <form action="{{ route('program-donasi.store') }}" method="POST">
          @csrf
          <div class="form-grid-2">
            <div class="form-group full-width">
              <label class="form-label">Judul Program</label>
              <input type="text" name="title" class="form-input-style" value="{{ old('title') }}" placeholder="Contoh: Beasiswa untuk Anak Yatim di Wilayah Terpencil" required />
            </div>
            <div class="form-group">
              <label class="form-label">Kategori</label>
              <select name="category" class="form-input-style" required>
                <option value="" disabled selected>Pilih kategori...</option>
                <option value="Pendidikan" @selected(old('category') === 'Pendidikan')>Pendidikan</option>
                <option value="Infrastruktur & Akses" @selected(old('category') === 'Infrastruktur & Akses')>Infrastruktur & Akses</option>
                <option value="Lingkungan" @selected(old('category') === 'Lingkungan')>Lingkungan</option>
                <option value="Inklusi & Kesetaraan" @selected(old('category') === 'Inklusi & Kesetaraan')>Inklusi & Kesetaraan</option>
                <option value="Lainnya" @selected(old('category') === 'Lainnya')>Lainnya</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Target Dana (Rp)</label>
              <input type="number" name="target_amount" min="100000" step="1000" class="form-input-style" value="{{ old('target_amount') }}" placeholder="Contoh: 25000000" required />
            </div>
            <div class="form-group">
              <label class="form-label">Tanggal Berakhir</label>
              <input type="date" name="end_date" class="form-input-style" value="{{ old('end_date') }}" min="{{ now()->addDay()->toDateString() }}" required />
            </div>
            <div class="form-group full-width">
              <label class="form-label">Deskripsi Program</label>
              <textarea name="description" class="form-input-style" rows="4" placeholder="Ceritakan tujuan dan dampak dari program donasi ini...">{{ old('description') }}</textarea>
            </div>
          </div>
          <div class="form-action-footer" style="justify-content:flex-end;">
            <button type="submit" class="btn-form-next">Ajukan Program Donasi</button>
          </div>
        </form>
      </div>

      @if ($myCampaigns->isNotEmpty())
      <div class="dash-section">
        <h3 class="dash-card-title">Program Donasi yang Sudah Kamu Buat</h3>
        <div class="inisiasi-why-grid">
          @foreach ($myCampaigns as $campaign)
            <div class="inisiasi-why-card">
              <h4>{{ $campaign->title }}</h4>
              <p>
                Terkumpul Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}
                dari target Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}
                &middot; {{ $campaign->transactions_count }} donatur
                &middot; Status: {{ ucfirst($campaign->status) }}
                &middot; Saldo tersedia: Rp {{ number_format($campaign->available_balance, 0, ',', '.') }}
              </p>
              <a href="{{ route('detail-program', $campaign) }}" style="color:#21A3FF;font-weight:600;text-decoration:none;">Lihat detail &rarr;</a>
              &nbsp;&middot;&nbsp;
              <a href="{{ route('pencairan-dana') }}" style="color:#21A3FF;font-weight:600;text-decoration:none;">Cairkan Dana &rarr;</a>
            </div>
          @endforeach
        </div>
      </div>
      @endif
      @endif

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

  <!-- ── TOMBOL GABUNG HERO (mobile floating, hanya ≤768px) ── -->
  <a href="{{ route('gabung-hero') }}" class="dash-mobile-hero-btn" aria-label="Gabung menjadi Hero">
    ✨ Gabung menjadi Hero!
  </a>

  <!-- ── BOTTOM NAV (mobile only) ── -->
  <nav class="dash-bottom-nav" aria-label="Navigasi mobile">
    <a href="{{ route('program-donasi') }}" class="dash-bnav-item" aria-label="Program Donasi">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
        <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
      </svg>
      Donasi
    </a>
    <a href="{{ route('kindlyshop') }}" class="dash-bnav-item" aria-label="KindlyShop">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <path d="M16 10a4 4 0 0 1-8 0"/>
      </svg>
      Shop
    </a>
    <a href="{{ route('dashboard') }}" class="dash-bnav-item bnav-center" aria-label="Beranda">
      <div class="bnav-icon-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
          <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
      </div>
      Beranda
    </a>
    <a href="{{ route('riwayat') }}" class="dash-bnav-item" aria-label="Riwayat">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
        <polyline points="7 10 12 15 17 10"/>
        <line x1="12" y1="15" x2="12" y2="3"/>
      </svg>
      Riwayat
    </a>
    <a href="{{ route('inisiasi') }}" class="dash-bnav-item active" aria-label="Inisiasi">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M18 11V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0"/>
        <path d="M14 10V4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v2"/>
        <path d="M10 10.5V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v8"/>
        <path d="M18 8a2 2 0 1 1 4 0v6a8 8 0 0 1-8 8h-2c-2.8 0-4.5-.86-5.99-2.34l-3.6-3.6a2 2 0 0 1 2.83-2.82L7 15"/>
      </svg>
      Inisiasi
    </a>
  </nav>

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