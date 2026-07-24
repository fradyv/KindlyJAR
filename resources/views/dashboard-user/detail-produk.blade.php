<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ $product->title }} · KindlyShop</title>
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
        <a href="{{ route('kindlyshop') }}" class="sidebar-link active">
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

    <div class="dash-topbar">
      <div class="dash-search-container">
        <a href="{{ route('kindlyshop') }}" style="display:flex;align-items:center;gap:6px;text-decoration:none;color:#3D3D4E;font-family:'Nunito',sans-serif;font-weight:700;font-size:.9rem;">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
          Kembali ke KindlyShop
        </a>
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

    <main class="dash-scroll">
      <div class="dash-main-card">

        <section style="display:flex;gap:32px;flex-wrap:wrap;align-items:flex-start;">
          <div style="flex:1 1 320px;max-width:420px;">
            <img src="{{ $product->product_preview ? asset($product->product_preview) : asset('assets/kata15.jpg') }}"
                 alt="{{ $product->title }}"
                 onerror="this.src='{{ asset('assets/kata15.jpg') }}'"
                 style="width:100%;border-radius:16px;object-fit:cover;aspect-ratio:1/1;background:#f1f4f8;" />
          </div>

          <div style="flex:1 1 380px;">
            <span class="product-tag">{{ $product->category ?? 'Digital Product' }}</span>
            <h1 style="font-family:'Nunito',sans-serif;font-weight:800;font-size:1.6rem;color:#3D3D4E;margin:10px 0 6px;">{{ $product->title }}</h1>
            <p style="font-family:'Nunito',sans-serif;font-weight:800;font-size:1.4rem;color:#21A3FF;margin:0 0 14px;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

            <p style="font-family:'Open Sans',sans-serif;color:#5b6474;line-height:1.7;margin-bottom:18px;">{{ $product->description }}</p>

            <div style="display:flex;gap:14px;align-items:center;margin-bottom:18px;font-family:'Nunito',sans-serif;font-size:.9rem;color:#6b7a8d;">
              <span>Stok: <strong style="color:#3D3D4E;">{{ $product->stock }}</strong></span>
              @if ($product->shop)
                <span>&middot;</span>
                <span>Toko: <strong style="color:#3D3D4E;">{{ $product->shop->name }}</strong></span>
              @endif
            </div>

            @if ($product->campaign)
              <a href="{{ route('detail-program', $product->campaign) }}" style="display:block;background:#f4f8ff;border:1px solid #dbeafe;border-radius:12px;padding:12px 16px;margin-bottom:20px;text-decoration:none;">
                <p style="margin:0;font-size:.75rem;color:#6b7a8d;font-family:'Nunito',sans-serif;font-weight:700;">Mendukung program donasi</p>
                <p style="margin:4px 0 0;font-size:.95rem;color:#21A3FF;font-family:'Nunito',sans-serif;font-weight:800;">{{ $product->campaign->title }} &rarr;</p>
              </a>
            @endif

            @if ($product->stock > 0 && (! $product->campaign || $product->campaign->acceptsContributions()))
              <form action="{{ route('keranjang.tambah', $product) }}" method="POST" style="display:flex;gap:12px;align-items:center;">
                @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                       style="width:80px;padding:10px 12px;border-radius:10px;border:1px solid #dfe4ee;font-family:'Nunito',sans-serif;font-weight:700;" />
                <button type="submit" class="btn-add-cart" style="padding:12px 28px;">+ Tambah ke Keranjang</button>
              </form>
            @elseif ($product->campaign && ! $product->campaign->acceptsContributions())
              <p style="color:#b3261e;font-family:'Nunito',sans-serif;font-weight:700;">Program donasi untuk produk ini sudah terpenuhi. Pembelian sementara ditutup.</p>
            @else
              <p style="color:#b3261e;font-family:'Nunito',sans-serif;font-weight:700;">Stok produk ini sedang habis.</p>
            @endif
          </div>
        </section>

        @if ($produkLainnya->isNotEmpty())
          <section class="dash-section dash-trending" style="margin-top:36px;">
            <h2 class="dash-card-title">Produk Lain dari Toko Ini</h2>
            <div class="shop-product-grid">
              @foreach ($produkLainnya as $lain)
                @php $lainImage = $lain->product_preview ? asset($lain->product_preview) : asset('assets/kata15.jpg'); @endphp
                <div class="product-card">
                  <a href="{{ route('detail-produk', $lain) }}" class="product-img"><img src="{{ $lainImage }}" alt="{{ $lain->title }}" onerror="this.src='{{ asset('assets/kata15.jpg') }}'" /></a>
                  <div class="product-body">
                    <span class="product-tag">{{ $lain->category ?? 'Digital Product' }}</span>
                    <h3 class="product-title"><a href="{{ route('detail-produk', $lain) }}" style="color:inherit;text-decoration:none;">{{ $lain->title }}</a></h3>
                    <p class="product-price">Rp {{ number_format($lain->price, 0, ',', '.') }}</p>
                    <div class="product-actions">
                      <a href="{{ route('detail-produk', $lain) }}" class="product-detail-link">Lihat detail</a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </section>
        @endif

      </div>
    </main>

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
</body>
</html>
