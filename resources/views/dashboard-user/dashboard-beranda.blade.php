<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Beranda · KindlyJAR</title>
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
        <a href="{{ route('dashboard') }}" class="sidebar-link active">
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

      @include('partials.dashboard-sidebar-extras')
    </div>
  </aside>

  <!-- ── KANAN: topbar (tidak scroll) + konten (scroll) ── -->
  <div class="dash-right">

    <!-- Topbar: selalu terlihat, tidak ikut scroll -->
    <div class="dash-topbar">
      <h1 class="dash-greeting">
        Selamat datang, <span class="dash-username" id="dashUsername">{{ auth()->user()->display_name }}</span>
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
    <!-- Area yang scroll -->
    <main class="dash-scroll">

      <!-- Satu card besar berisi semua section -->
    <div class="dash-main-card">

      <!-- Section 1: Ringkasan -->
      <section class="dash-section">
        <h2 class="dash-card-title">Ringkasan Dampak Kebaikanmu</h2>
        <p class="dash-card-sub">Pantau terus perkembangan donasi dan performa karya kreatifmu di sini.</p>

        <div class="summary-row">
          <div class="summary-card primary">
            <p class="summary-value">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</p>
            <p class="summary-label">Total Donasi</p>
          </div>
          <div class="summary-card">
            <p class="summary-value">{{ number_format($karyaTerjual) }}</p>
            <p class="summary-label">Karya Terjual</p>
          </div>
          <div class="summary-card">
            <p class="summary-value">{{ number_format($inisiasiProgram) }}</p>
            <p class="summary-label">Inisiasi Program</p>
          </div>
          <div class="summary-card">
            <p class="summary-value">Rp {{ number_format($pencairanDana, 0, ',', '.') }}</p>
            <p class="summary-label">Pencairan Dana</p>
          </div>
        </div>
      </section>

      <!-- Section 2: Riwayat Aktivitas -->
      <section class="dash-section">
        <h2 class="dash-card-title">Riwayat Aktivitas Donasi</h2>
        
        <div class="history-box">
          <div class="table-wrap">
            <table class="activity-table">
              <thead>
                <tr>
                  <th>ID Transaksi</th>
                  <th>Program Donasi</th>
                  <th>Tanggal</th>
                  <th>Jumlah</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="historyTableBody">
                @forelse($riwayatAktivitas as $transaksi)
                  <tr>
                    <td>#KJ-{{ str_pad($transaksi->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ optional($transaksi->campaign)->title ?? '-' }}</td>
                    <td>{{ optional($transaksi->payment_time ?? $transaksi->created_at)->translatedFormat('d M Y') ?? '—' }}</td>
                    <td>Rp {{ number_format($transaksi->total_paid, 0, ',', '.') }}</td>
                    <td>
                      @if($transaksi->status === 'success')
                        <span class="badge berhasil">&#9679; Berhasil</span>
                      @elseif($transaksi->status === 'pending')
                        <span class="badge pending">&#9679; Menunggu</span>
                      @else
                        <span class="badge gagal">&#9679; Gagal</span>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" style="text-align:center; color:#b0b7c3;">Belum ada aktivitas donasi.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- Section 3: Trending -->
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
            <div class="trending-card">
              <div class="trending-img">
                <img src="{{ $campaignImage }}" alt="{{ $campaign->title }}" onerror="this.src='{{ asset('assets/kata15.jpg') }}'" />
              </div>
              <div class="trending-body">
                <h3 class="trending-title">{{ $campaign->title }}</h3>
                <div class="t-progress">
                  <div class="t-bar"><div class="t-fill" style="width:{{ $percentage }}%"></div></div>
                  <span class="t-pct">{{ $percentage }}% Terpenuhi</span>
                </div>
                <a href="{{ route('detail-program', $campaign) }}" class="btn-t-donasi" style="display:inline-block;text-align:center;text-decoration:none;">Donasi!</a>
                <a href="{{ route('detail-program', $campaign) }}" class="t-detail">Lihat detail</a>
              </div>
            </div>
          @empty
            <p class="shop-empty-state">Belum ada program donasi aktif.</p>
          @endforelse
        </div>
      </section>

    </div><!-- /.dash-main-card -->
    </main>

    <!-- Dropdowns: absolute dalam .dash-right, tidak ikut scroll sama sekali -->
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
  <a href="{{ route('gabung-hero') }}" class="dash-mobile-hero-btn" aria-label="Gabung menjadi Hero" id="mobileHeroBtn">
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
    <a href="{{ route('dashboard') }}" class="dash-bnav-item bnav-center active" aria-label="Beranda">
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
  @include('partials.dash-dropdown-script')
</body>
</html>
