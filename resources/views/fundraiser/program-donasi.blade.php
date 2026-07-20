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
      
      <!-- SEARCH BAR BARU -->
      <div class="dash-search-container">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#718096" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="search-icon">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" id="donationSearchInput" placeholder="Jelajahi Program Donasi" class="dash-search-input" />
      </div>

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
        <section class="donation-header-banner">
        <div class="banner-text-content">
          <h2>Ubah Masa Depan Lewat Bentangan Kebaikan</h2>
          <p>Salurkan bantuanmu secara transparan untuk memfasilitasi sekolah, guru, dan siswa di seluruh pelosok Nusantara.</p>
        </div>
        <div class="banner-image-container">
          <img src="{{ asset('assets/header-donation-pic.jpg') }}" alt="Bentangan Kebaikan" class="banner-fade-img" />
        </div>
      </section>
      <!-- Area Tombol Kategori yang sudah ada sebelumnya -->
        <div class="category-filter-row">
        <!-- Tombol-tombol kategorimu berada di sini... -->
        </div>

        <!-- ── TAMBAHKAN SECTION INI DI BAWAHNYA ── -->
        <section class="dash-section dash-trending">
        <h2 class="dash-card-title">Paling Banyak Dibantu Pekan Ini</h2>
        <p class="dash-card-sub">Yuk, ikut berkontribusi di program yang sedang ramai didukung oleh Hero lainnya.</p>

        <div class="trending-grid">
          @forelse($trendingCampaigns as $campaign)
            @php
              $percentage = $campaign->target_amount > 0
                ? min(100, round(($campaign->collected_amount / $campaign->target_amount) * 100))
                : 0;
              $preview = optional($campaign->products->first())->product_preview;
              $campaignImage = $preview ? asset($preview) : asset('assets/kata15.jpg');
            @endphp

            <div class="trending-card" data-campaign-id="{{ $campaign->id }}" data-category="{{ Str::slug($campaign->category ?? 'lainnya') }}" data-title="{{ Str::lower($campaign->title) }}">
              <div class="trending-img">
                <img src="{{ $campaignImage }}" alt="{{ $campaign->title }}" onerror="this.src='{{ asset('assets/kata15.jpg') }}'" />
              </div>
              <div class="trending-body">
                <h3 class="trending-title">{{ $campaign->title }}</h3>
                <p class="trending-desc">{{ Str::limit($campaign->description, 120) }}</p>
                <div class="t-progress">
                  <div class="t-bar">
                    <div class="t-fill" style="width:{{ $percentage }}%"></div>
                  </div>
                  <span class="t-pct">{{ $percentage }}% Terpenuhi</span>
                </div>
                <button class="btn-t-donasi">Donasi!</button>
                <a href="{{ route('detail-program') }}" class="t-detail">Lihat detail</a>
              </div>
            </div>
          @empty
            <p class="shop-empty-state">Belum ada program donasi aktif.</p>
          @endforelse
      
        </div>
        </section>

        <!-- ── SECTION: BARU DILUNCURKAN ── -->
      <section class="dash-trending">
        <h2 class="dash-card-title">Baru Diluncurkan, Menanti Uluran Tangan</h2>
        <p class="dash-card-sub">Program-program ini baru saja hadir dan masih butuh dorongan awal darimu.</p>
        
        <div class="trending-grid">
          @forelse($newCampaigns as $campaign)
            @php
              $percentage = $campaign->target_amount > 0
                ? min(100, round(($campaign->collected_amount / $campaign->target_amount) * 100))
                : 0;
              $preview = optional($campaign->products->first())->product_preview;
              $campaignImage = $preview ? asset($preview) : asset('assets/kata15.jpg');
            @endphp

            <div class="trending-card" data-category="{{ Str::slug($campaign->category ?? 'lainnya') }}" data-title="{{ Str::lower($campaign->title) }}">
              <div class="trending-img">
                <img src="{{ $campaignImage }}" alt="{{ $campaign->title }}" onerror="this.src='{{ asset('assets/kata15.jpg') }}'" />
              </div>
              <div class="trending-body">
                <h3 class="trending-title">{{ $campaign->title }}</h3>
                <p class="trending-desc" style="font-family: 'Open Sans', sans-serif; font-size: 0.85rem; color: #718096; margin-bottom: 10px; line-height: 1.4;">
                  {{ Str::limit($campaign->description, 120) }}
                </p>
                <div class="t-progress">
                  <div class="t-bar"><div class="t-fill" style="width: {{ $percentage }}%"></div></div>
                  <span class="t-pct">{{ $percentage }}% Terpenuhi</span>
                </div>
                <button class="btn-t-donasi">Donasi!</button>
                <a href="{{ route('detail-program') }}" class="t-detail">Lihat detail</a>
              </div>
            </div>
          @empty
            <p class="shop-empty-state">Belum ada program baru.</p>
          @endforelse

        </div><!-- /.trending-grid -->
      </section>
      <div class="category-filter-row" id="donationCategoryRow">
          <!-- Semua -->
          <button class="btn-category-pill active" data-filter="semua">
            <span>Semua</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>

          <!-- Pendidikan -->
          <button class="btn-category-pill" data-filter="pendidikan">
            <span>Pendidikan</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>

          <!-- Infrastruktur & Akses -->
          <button class="btn-category-pill" data-filter="infrastruktur-akses">
            <span>Infrastruktur & Akses</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>

          <!-- Lingkungan -->
          <button class="btn-category-pill" data-filter="lingkungan">
            <span>Lingkungan</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>

          <!-- Inklusi & Kesetaraan -->
          <button class="btn-category-pill" data-filter="inklusi-kesetaraan">
            <span>Inklusi & Kesetaraan</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>

          <!-- Lainnya -->
          <button class="btn-category-pill" data-filter="lainnya">
            <span>Lainnya</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
        </div>

        <!-- ── SECTION: DAFTAR DONASI HORIZONTAL ── -->
        <section class="horizontal-donation-section">
        <div class="horizontal-donation-list">

            @forelse($campaigns as $campaign)
            @php
              $percentage = $campaign->target_amount > 0
                ? min(100, round(($campaign->collected_amount / $campaign->target_amount) * 100))
                : 0;
              $preview = optional($campaign->products->first())->product_preview;
              $campaignImage = $preview ? asset($preview) : asset('assets/kata15.jpg');
            @endphp

            <div class="donation-card-horizontal" data-category="{{ Str::slug($campaign->category ?? 'lainnya') }}" data-title="{{ Str::lower($campaign->title) }}">
            <div class="card-horizontal-img">
                <img src="{{ $campaignImage }}" alt="{{ $campaign->title }}" onerror="this.src='{{ asset('assets/kata15.jpg') }}'" />
            </div>
            <div class="card-horizontal-body">
                <h3 class="card-horizontal-title">{{ $campaign->title }}</h3>

                <div class="card-horizontal-badges">
                <button class="btn-category-pill">
                    <span>{{ $campaign->category ?? 'Lainnya' }}</span>
                    <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                </div>

                <div class="card-horizontal-meta">
                <div class="meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#21A3FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <span>{{ optional($campaign->fundraiser)->display_name ?? 'Indonesia' }}</span>
                </div>
                <div class="meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#21A3FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>{{ number_format($campaign->transactions_count) }} Membantu</span>
                </div>
                </div>

                <div class="card-horizontal-progress">
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: {{ $percentage }}%;"></div>
                </div>
                <span class="progress-target">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }} / Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                </div>

                <div class="card-horizontal-actions">
                <button class="btn-horizontal-donasi">Donasi!</button>
                <a href="{{ route('detail-program') }}" class="horizontal-detail-link">Lihat detail</a>
                </div>
            </div>
            </div>
            @empty
            <p class="shop-empty-state">Belum ada program donasi.</p>
            @endforelse

        </div>
        </section>

        <p class="shop-empty-state" id="donationEmptyState" style="display:none;">Program tidak ditemukan.</p>

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
    <a href="{{ route('program-donasi') }}" class="dash-bnav-item active" aria-label="Program Donasi">
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
    <a href="{{ route('inisiasi') }}" class="dash-bnav-item" aria-label="Inisiasi">
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

    // Filter kategori + search Program Donasi
    const donationCategoryRow = document.getElementById('donationCategoryRow');
    const donationCards       = Array.from(document.querySelectorAll('.trending-card, .donation-card-horizontal'));
    const donationSearchInput = document.getElementById('donationSearchInput');
    const donationEmptyState  = document.getElementById('donationEmptyState');
    let activeDonationFilter = 'semua';

    function applyDonationFilter() {
      const query = donationSearchInput.value.trim().toLowerCase();
      let visibleCount = 0;

      donationCards.forEach((card) => {
        const matchesCategory = activeDonationFilter === 'semua' || card.dataset.category === activeDonationFilter;
        const matchesSearch = !query || card.dataset.title.includes(query);
        const show = matchesCategory && matchesSearch;
        card.style.display = show ? '' : 'none';
        if (show) visibleCount++;
      });

      donationEmptyState.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    donationCategoryRow.addEventListener('click', (e) => {
      const pill = e.target.closest('.btn-category-pill');
      if (!pill) return;
      donationCategoryRow.querySelectorAll('.btn-category-pill').forEach((p) => p.classList.remove('active'));
      pill.classList.add('active');
      activeDonationFilter = pill.dataset.filter;
      applyDonationFilter();
    });

    donationSearchInput.addEventListener('input', applyDonationFilter);
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