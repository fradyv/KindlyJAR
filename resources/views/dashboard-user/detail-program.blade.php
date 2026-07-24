<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ $campaign->title }} · KindlyJAR</title>
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
      </nav>

      @include('partials.dashboard-sidebar-extras')
    </div>
  </aside>

  <!-- ── KANAN: topbar (tidak scroll) + konten (scroll) ── -->
  <div class="dash-right">

    <!-- Topbar: selalu terlihat, tidak ikut scroll -->
    <div class="dash-topbar">
      <h1 class="dash-greeting">
        Program Donasi · <span class="dash-username" id="dashUsername">{{ auth()->user()->display_name }}</span>
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
            @include('partials.user-avatar')
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

    @include('partials.flash-messages')
    @include('partials.verification-banner')

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

        @php
          $preview = optional($campaign->products->first())->product_preview;
          $campaignImage = $preview ? asset($preview) : asset('assets/kata15.jpg');
          $percentage = $campaign->target_amount > 0
            ? min(100, round(($campaign->collected_amount / $campaign->target_amount) * 100))
            : 0;
          $sisaHari = $campaign->end_date ? max(0, now()->diffInDays($campaign->end_date, false)) : null;
        @endphp

        <!-- 1. HERO BANNER -->
        <div class="detail-hero">
        <img src="{{ $campaignImage }}" alt="{{ $campaign->title }}" class="detail-hero-img" onerror="this.src='{{ asset('assets/kata15.jpg') }}'" />
        <div class="detail-hero-overlay">
            <span class="detail-badge">{{ $campaign->category ?? 'Lainnya' }}</span>
            <h1 class="detail-judul">{{ $campaign->title }}</h1>
            <p class="detail-penyelenggara">oleh <strong>{{ optional($campaign->fundraiser)->display_name ?? 'KindlyJAR' }}</strong></p>
        </div>
        </div>

        <!-- 2. PROGRESS DONASI -->
        <div class="detail-progress-box">
        <div class="detail-progress-bar-wrap">
            <div class="detail-progress-fill" style="width: {{ $percentage }}%"></div>
        </div>
        <div class="detail-progress-stats">
            <div>
            <p class="detail-stat-value">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</p>
            <p class="detail-stat-label">Terkumpul dari Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
            </div>
            <div class="detail-stat-right">
            <span class="detail-pct">{{ $percentage }}%</span>
            </div>
        </div>
        <div class="detail-meta-row">
            <span>👥 {{ number_format($campaign->transactions_count) }} donatur</span>
            @if($sisaHari !== null)
            <span>⏳ {{ $sisaHari }} hari lagi</span>
            @endif
        </div>
        </div>

        <!-- 3. FORM DONASI -->
        <div class="detail-section" id="donasiForm">
        <h2 class="detail-section-title">Donasi untuk Program Ini</h2>

        @if ($errors->any())
          <div class="verification-banner" style="background:#fef2f2;border-color:#fecaca;margin-bottom:16px;">
            <div class="banner-content">
              <span class="banner-icon">⚠️</span>
              <p>{{ $errors->first() }}</p>
            </div>
          </div>
        @endif

        <form method="POST" action="{{ route('donasi.store', $campaign) }}">
            @csrf
            <div class="donasi-modal-section">
              <p class="donasi-modal-label">Pilih Nominal</p>
              <div class="donasi-nominal-grid">
                <button type="button" class="donasi-nominal-btn" data-nominal="25000">Rp 25.000</button>
                <button type="button" class="donasi-nominal-btn" data-nominal="50000">Rp 50.000</button>
                <button type="button" class="donasi-nominal-btn" data-nominal="100000">Rp 100.000</button>
                <button type="button" class="donasi-nominal-btn" data-nominal="250000">Rp 250.000</button>
              </div>
              <input type="number" name="nominal" id="donasiNominalInput" class="donasi-input-custom" placeholder="Atau masukkan nominal lain" min="1000" required />
            </div>

            <div class="donasi-modal-section">
              <label class="donasi-checkbox-row">
                <input type="checkbox" name="is_anonymous" value="1" />
                Donasi sebagai anonim / Hamba Allah
              </label>
            </div>

            <div class="donasi-modal-section">
              <p class="donasi-modal-label">Metode Pembayaran</p>
              <div class="donasi-metode-list">
                <label class="donasi-metode-item">
                  <input type="radio" name="bank_name" value="Transfer Bank" checked />
                  <span>🏦 Transfer Bank</span>
                </label>
                <label class="donasi-metode-item">
                  <input type="radio" name="bank_name" value="E-Wallet" />
                  <span>📱 E-Wallet</span>
                </label>
                <label class="donasi-metode-item">
                  <input type="radio" name="bank_name" value="Kartu Kredit" />
                  <span>💳 Kartu Kredit</span>
                </label>
              </div>
            </div>

            <button type="submit" class="btn-donasi-besar btn-form-next" style="width:100%;">Donasi Sekarang</button>
        </form>
        </div>

        <!-- 4. DESKRIPSI PROGRAM -->
        <div class="detail-section">
        <h2 class="detail-section-title">Latar Belakang</h2>
        <p class="detail-text">{{ $campaign->description }}</p>
        </div>

        <!-- 5. PRODUK DIGITAL TERKAIT -->
        @if($campaign->products->isNotEmpty())
        <div class="detail-section">
        <h2 class="detail-section-title">Produk Digital Pendukung Program Ini</h2>
        <div class="trending-grid">
          @foreach($campaign->products as $product)
            <div class="product-card">
              <div class="product-img"><img src="{{ $product->product_preview ? asset($product->product_preview) : asset('assets/kata15.jpg') }}" alt="{{ $product->title }}" /></div>
              <div class="product-body">
                <span class="product-tag">{{ $product->category ?? 'Digital Product' }}</span>
                <h3 class="product-title">{{ $product->title }}</h3>
                <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <div class="product-actions">
                  <a href="{{ route('kindlyshop') }}" class="product-detail-link">Beli di KindlyShop</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        </div>
        @endif

        <!-- 6. DONATUR TERBARU -->
        <div class="detail-section">
        <h2 class="detail-section-title">Donatur Terbaru</h2>
        <div class="detail-donatur-list">
            @forelse($donaturTerbaru as $donasi)
              @php
                $namaDonatur = $donasi->is_anonymous ? 'Hamba Allah' : optional($donasi->buyer)->display_name;
                $namaDonatur = $namaDonatur ?: 'Anonim';
              @endphp
              <div class="detail-donatur-item">
              <div class="detail-donatur-avatar">{{ Str::upper(Str::substr($namaDonatur, 0, 1)) }}</div>
              <div>
                  <p class="detail-donatur-name">{{ $namaDonatur }}</p>
                  <p class="detail-donatur-time">{{ optional($donasi->payment_time ?? $donasi->created_at)->diffForHumans() ?? '—' }}</p>
              </div>
              <span class="detail-donatur-nominal">Rp {{ number_format($donasi->total_paid, 0, ',', '.') }}</span>
              </div>
            @empty
              <p class="shop-empty-state">Belum ada donatur. Jadilah yang pertama!</p>
            @endforelse
        </div>
        </div>

        <!-- 7. PROGRAM SERUPA -->
        @if($programSerupa->isNotEmpty())
        <div class="detail-section">
        <h2 class="detail-section-title">Program Serupa</h2>
        <div class="trending-grid">
            @foreach($programSerupa as $serupa)
            @php
              $pctSerupa = $serupa->target_amount > 0
                ? min(100, round(($serupa->collected_amount / $serupa->target_amount) * 100))
                : 0;
              $previewSerupa = optional($serupa->products->first())->product_preview;
              $imgSerupa = $previewSerupa ? asset($previewSerupa) : asset('assets/kata15.jpg');
            @endphp
            <div class="trending-card">
            <div class="trending-img"><img src="{{ $imgSerupa }}" alt="{{ $serupa->title }}" /></div>
            <div class="trending-body">
                <div class="trending-title">{{ $serupa->title }}</div>
                <div class="t-progress">
                <div class="t-bar"><div class="t-fill" style="width:{{ $pctSerupa }}%"></div></div>
                <span class="t-pct">{{ $pctSerupa }}% Terpenuhi</span>
                </div>
                <a href="{{ route('detail-program', $serupa) }}" class="btn-t-donasi btn-donasi" style="display:inline-block;text-align:center;text-decoration:none;">Lihat Program</a>
            </div>
            </div>
            @endforeach
        </div>
        </div>
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

  <script src="{{ asset('global/script.js') }}"></script>
  @include('partials.dash-dropdown-script')
  <script>
    // ── Isi nominal donasi dari tombol pilihan ──
    document.querySelectorAll('.donasi-nominal-btn').forEach((btn) => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.donasi-nominal-btn').forEach((b) => b.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('donasiNominalInput').value = btn.dataset.nominal;
      });
    });
  </script>
</body>
</html>
