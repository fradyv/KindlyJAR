<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>KindlyShop · KindlyJAR</title>
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

  <!-- ── KANAN: topbar (tidak scroll) + konten (scroll) ── -->
  <div class="dash-right">

    <!-- Topbar: selalu terlihat, tidak ikut scroll -->
    <div class="dash-topbar">

      <!-- SEARCH BAR (komponen sama seperti Program Donasi) -->
      <div class="dash-search-container">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#718096" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="search-icon">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" id="shopSearchInput" placeholder="Cari produk di KindlyShop" class="dash-search-input" />
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

      <div class="dash-main-card">

        <!-- Banner header ala Program Donasi -->
        <section class="donation-header-banner">
          <div class="banner-text-content">
            <h2>Belanja Karya, Sokong Kebaikan</h2>
            <p>Setiap produk digital yang kamu beli di KindlyShop turut mendanai program donasi para Hero di seluruh Nusantara.</p>
          </div>
          <div class="banner-image-container">
            <img src="{{ asset('assets/kata14.jpg') }}" alt="KindlyShop" class="banner-fade-img" />
          </div>
        </section>

        <!-- Kategori (komponen sama seperti Program Donasi) -->
        <div class="category-filter-row" id="shopCategoryRow">
          <button class="btn-category-pill active" data-filter="semua">
            <span>Semua</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <button class="btn-category-pill" data-filter="desain-poster">
            <span>Desain Poster</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <button class="btn-category-pill" data-filter="ilustrasi-digital">
            <span>Ilustrasi Digital</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <button class="btn-category-pill" data-filter="desain-web">
            <span>Desain Web</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <button class="btn-category-pill" data-filter="aset-3d">
            <span>Aset 3D</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <button class="btn-category-pill" data-filter="desain-logo">
            <span>Desain Logo</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <button class="btn-category-pill" data-filter="stok-foto">
            <span>Stok Foto</span>
            <svg class="chevron-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
        </div>

        <!-- Grid Produk ala e-Bay -->
        <section class="dash-section dash-trending">
          <h2 class="dash-card-title">Katalog Produk Digital</h2>
          <p class="dash-card-sub">Aset kreatif premium pilihan dari Hero untuk mendukung pemerataan Nusantara.</p>

          <div class="shop-product-grid" id="shopProductGrid">

            <div class="product-card" data-category="desain-poster" data-title="poster retro do what excites dwe playbook">
              <div class="product-img"><img src="{{ asset('assets/kata1.jpg') }}" alt="Poster Retro 'Do What Excites' - DWE Playbook Vol. 2" /></div>
              <div class="product-body">
                <span class="product-tag">Desain Poster</span>
                <h3 class="product-title">Poster Retro "Do What Excites" - DWE Playbook Vol. 2</h3>
                <p class="product-price">Rp 25.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="ilustrasi-digital" data-title="ilustrasi potret lily dan senja">
              <div class="product-img"><img src="{{ asset('assets/kata16.jpg') }}" alt="Ilustrasi Potret 'Lily & Senja'" /></div>
              <div class="product-body">
                <span class="product-tag">Ilustrasi Digital</span>
                <h3 class="product-title">Ilustrasi Potret "Lily & Senja"</h3>
                <p class="product-price">Rp 35.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="desain-poster" data-title="poster retro yuji staff pengmas">
              <div class="product-img"><img src="{{ asset('assets/kata2.jpg') }}" alt="Poster Retro 'YUJI Staff Pengmas'" /></div>
              <div class="product-body">
                <span class="product-tag">Desain Poster</span>
                <h3 class="product-title">Poster Retro "YUJI Staff Pengmas"</h3>
                <p class="product-price">Rp 22.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="desain-poster" data-title="poster infografis hardest records to break euroleague">
              <div class="product-img"><img src="{{ asset('assets/kata3.jpg') }}" alt="Poster Infografis 'Hardest Records to Break'" /></div>
              <div class="product-body">
                <span class="product-tag">Desain Poster</span>
                <h3 class="product-title">Poster Infografis "Hardest Records to Break"</h3>
                <p class="product-price">Rp 20.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="desain-web" data-title="desain web crumb theory bakery landing page">
              <div class="product-img"><img src="{{ asset('assets/kata4.jpg') }}" alt="Desain Web 'Crumb Theory' Bakery Landing Page" /></div>
              <div class="product-body">
                <span class="product-tag">Desain Web</span>
                <h3 class="product-title">Desain Web "Crumb Theory" Bakery Landing Page</h3>
                <p class="product-price">Rp 150.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="desain-logo" data-title="brand identity kit lune ice cream tea coffee">
              <div class="product-img"><img src="{{ asset('assets/kata5.jpg') }}" alt="Brand Identity Kit 'LUNE' Ice Cream, Tea & Coffee" /></div>
              <div class="product-body">
                <span class="product-tag">Desain Logo</span>
                <h3 class="product-title">Brand Identity Kit "LUNE" Ice Cream, Tea & Coffee</h3>
                <p class="product-price">Rp 175.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="aset-3d" data-title="diorama 3d isometric halte malam">
              <div class="product-img"><img src="{{ asset('assets/kata6.jpg') }}" alt="Diorama 3D Isometric 'Halte Malam'" /></div>
              <div class="product-body">
                <span class="product-tag">Aset 3D</span>
                <h3 class="product-title">Diorama 3D Isometric "Halte Malam"</h3>
                <p class="product-price">Rp 55.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="aset-3d" data-title="diorama 3d isometric ruang baca cozy">
              <div class="product-img"><img src="{{ asset('assets/kata15.jpg') }}" alt="Diorama 3D Isometric 'Ruang Baca Cozy'" /></div>
              <div class="product-body">
                <span class="product-tag">Aset 3D</span>
                <h3 class="product-title">Diorama 3D Isometric "Ruang Baca Cozy"</h3>
                <p class="product-price">Rp 80.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="aset-3d" data-title="diorama 3d isometric kedai mie ayam">
              <div class="product-img"><img src="{{ asset('assets/kata7.jpg') }}" alt="Diorama 3D Isometric 'Kedai Mie Ayam'" /></div>
              <div class="product-body">
                <span class="product-tag">Aset 3D</span>
                <h3 class="product-title">Diorama 3D Isometric "Kedai Mie Ayam"</h3>
                <p class="product-price">Rp 65.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="desain-logo" data-title="logo maskot moji matcha">
              <div class="product-img"><img src="{{ asset('assets/kata8.jpg') }}" alt="Logo Maskot 'Moji Matcha'" /></div>
              <div class="product-body">
                <span class="product-tag">Desain Logo</span>
                <h3 class="product-title">Logo Maskot "Moji Matcha"</h3>
                <p class="product-price">Rp 45.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="desain-logo" data-title="logo dan badge midnight raven coffee house">
              <div class="product-img"><img src="{{ asset('assets/kata9.jpg') }}" alt="Logo & Badge 'Midnight Raven Coffee House'" /></div>
              <div class="product-body">
                <span class="product-tag">Desain Logo</span>
                <h3 class="product-title">Logo & Badge "Midnight Raven Coffee House"</h3>
                <p class="product-price">Rp 40.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="ilustrasi-digital" data-title="ilustrasi digital potret crimson veil">
              <div class="product-img"><img src="{{ asset('assets/kata10.jpg') }}" alt="Ilustrasi Digital Potret 'Crimson Veil'" /></div>
              <div class="product-body">
                <span class="product-tag">Ilustrasi Digital</span>
                <h3 class="product-title">Ilustrasi Digital Potret "Crimson Veil"</h3>
                <p class="product-price">Rp 30.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="ilustrasi-digital" data-title="ilustrasi karakter gadis dan kucing putih">
              <div class="product-img"><img src="{{ asset('assets/kata11.jpg') }}" alt="Ilustrasi Karakter 'Gadis dan Kucing Putih'" /></div>
              <div class="product-body">
                <span class="product-tag">Ilustrasi Digital</span>
                <h3 class="product-title">Ilustrasi Karakter "Gadis dan Kucing Putih"</h3>
                <p class="product-price">Rp 32.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="aset-3d" data-title="ikon 3d komputer retro">
              <div class="product-img"><img src="{{ asset('assets/kata14.jpg') }}" alt="Ikon 3D 'Komputer Retro'" /></div>
              <div class="product-body">
                <span class="product-tag">Aset 3D</span>
                <h3 class="product-title">Ikon 3D "Komputer Retro"</h3>
                <p class="product-price">Rp 58.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="stok-foto" data-title="foto stok aksi skateboard">
              <div class="product-img"><img src="{{ asset('assets/kata12.jpg') }}" alt="Foto Stok 'Aksi Skateboard'" /></div>
              <div class="product-body">
                <span class="product-tag">Stok Foto</span>
                <h3 class="product-title">Foto Stok "Aksi Skateboard"</h3>
                <p class="product-price">Rp 15.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="stok-foto" data-title="foto stok diskusi kolega kantor">
              <div class="product-img"><img src="{{ asset('assets/kata13.jpg') }}" alt="Foto Stok 'Diskusi Kolega Kantor'" /></div>
              <div class="product-body">
                <span class="product-tag">Stok Foto</span>
                <h3 class="product-title">Foto Stok "Diskusi Kolega Kantor"</h3>
                <p class="product-price">Rp 15.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

            <div class="product-card" data-category="desain-logo" data-title="logo the dairy farm">
              <div class="product-img"><img src="{{ asset('assets/kata17.jpg') }}" alt="Logo 'The Dairy Farm'" /></div>
              <div class="product-body">
                <span class="product-tag">Desain Logo</span>
                <h3 class="product-title">Logo "The Dairy Farm"</h3>
                <p class="product-price">Rp 42.000</p>
                <div class="product-actions">
                  <button class="btn-add-cart">+ Keranjang</button>
                  <a href="#" class="product-detail-link">Lihat detail</a>
                </div>
              </div>
            </div>

          </div><!-- /.shop-product-grid -->

          <p class="shop-empty-state" id="shopEmptyState" style="display:none;">Produk tidak ditemukan.</p>
        </section>

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
    <a href="{{ route('kindlyshop') }}" class="dash-bnav-item active" aria-label="KindlyShop">
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

    // Filter kategori + search produk KindlyShop
    const categoryRow   = document.getElementById('shopCategoryRow');
    const productCards  = Array.from(document.querySelectorAll('#shopProductGrid .product-card'));
    const searchInput   = document.getElementById('shopSearchInput');
    const emptyState    = document.getElementById('shopEmptyState');
    let activeFilter = 'semua';

    function applyShopFilter() {
      const query = searchInput.value.trim().toLowerCase();
      let visibleCount = 0;

      productCards.forEach((card) => {
        const matchesCategory = activeFilter === 'semua' || card.dataset.category === activeFilter;
        const matchesSearch = !query || card.dataset.title.includes(query);
        const show = matchesCategory && matchesSearch;
        card.style.display = show ? '' : 'none';
        if (show) visibleCount++;
      });

      emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    categoryRow.addEventListener('click', (e) => {
      const pill = e.target.closest('.btn-category-pill');
      if (!pill) return;
      categoryRow.querySelectorAll('.btn-category-pill').forEach((p) => p.classList.remove('active'));
      pill.classList.add('active');
      activeFilter = pill.dataset.filter;
      applyShopFilter();
    });

    searchInput.addEventListener('input', applyShopFilter);
  </script>
</body>
</html>
