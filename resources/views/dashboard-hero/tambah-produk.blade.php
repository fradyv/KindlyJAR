<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Produk · KindlyJAR</title>
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

      <div class="sidebar-cta" id="sidebarHeroCta" style="display:none;">
        <a href="{{ route('gabung-hero') }}">
          <button class="btn-join-hero">Gabung menjadi Hero!</button>
        </a>
      </div>

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
          <a href="{{ route('tambah-produk') }}" class="sidebar-link active">
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

    <div class="dash-topbar">
      <h1 class="dash-greeting">Tambah Produk</h1>
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

    <main class="dash-scroll">
      <div class="dash-main-card">

        <!-- Belum jadi Hero -->
        <section class="dash-section" id="belumHeroNotice" style="display:none;">
          <h2 class="dash-card-title">Kamu Belum Punya Toko</h2>
          <p class="dash-card-sub">Daftar jadi Hero dulu buat bisa nambah produk jualan di KindlyShop.</p>
          <a href="{{ route('gabung-hero') }}" class="btn-hero inisiasi-cta-btn">Gabung Jadi Hero</a>
        </section>

        <!-- Sudah jadi Hero -->
        <section class="dash-section" id="tambahProdukContent" style="display:none;">
          <h2 class="dash-card-title">Tambah Produk Baru</h2>
          <p class="dash-card-sub">Isi detail produk yang mau kamu jual di KindlyShop.</p>

          <form id="tambahProdukForm" autocomplete="off">
            <div class="form-grid-2">
              <div class="form-group">
                <label class="form-label">Nama Produk</label>
                <input type="text" class="form-input-style" id="produkNamaInput" placeholder="Contoh: Poster Ilustrasi Senja" required />
              </div>
              <div class="form-group">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" class="form-input-style" id="produkHargaInput" placeholder="Contoh: 25000" min="0" required />
              </div>
              <div class="form-group full-width">
                <label class="form-label">Kategori Produk</label>
                <select class="form-input-style" id="produkKategoriInput" required>
                  <option value="" disabled selected>Pilih kategori produk...</option>
                  <option value="desain-poster">Desain Poster</option>
                  <option value="ilustrasi-digital">Ilustrasi Digital</option>
                  <option value="desain-web">Desain Web</option>
                  <option value="aset-3d">Aset 3D</option>
                  <option value="desain-logo">Desain Logo</option>
                  <option value="stok-foto">Stok Foto</option>
                </select>
              </div>
              <div class="form-group full-width">
                <label class="form-label">Deskripsi Produk</label>
                <textarea class="form-input-style" id="produkDeskripsiInput" rows="3" placeholder="Ceritain produk kamu..." required></textarea>
              </div>
              <div class="form-group full-width">
                <label class="form-label">Upload Foto Produk</label>
                <div class="custom-file-upload">
                  <span class="upload-icon-style">🖼️</span>
                  <span class="upload-text-main" id="produkFotoLabel">Pilih Foto Produk</span>
                  <span class="upload-text-sub">Format: JPG, PNG max 5MB</span>
                  <input type="file" id="produkFotoInput" accept="image/*" />
                </div>
              </div>
            </div>

            <div class="form-action-footer">
              <a href="{{ route('toko-saya') }}" class="btn-form-back">Batal</a>
              <button type="submit" class="btn-form-next">Simpan Produk</button>
            </div>
          </form>
        </section>

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
    const notifBtn2      = document.getElementById('notifBtn');
    const notifDropdown2 = document.getElementById('notifDropdown');
    const profileBtn2    = document.getElementById('profileBtn');
    const profileDropdown2 = document.getElementById('profileDropdown');
    const dashRight2     = document.querySelector('.dash-right');

    function positionDropdown2(dropdown, anchor) {
      const pr = dashRight2.getBoundingClientRect();
      const ar = anchor.getBoundingClientRect();
      dropdown.style.top   = (ar.bottom - pr.top + 8) + 'px';
      dropdown.style.right = (pr.right - ar.right) + 'px';
      dropdown.style.left  = 'auto';
    }

    notifBtn2.addEventListener('click', (e) => {
      e.stopPropagation();
      const opening = !notifDropdown2.classList.contains('open');
      profileDropdown2.classList.remove('open');
      if (opening) {
        positionDropdown2(notifDropdown2, notifBtn2);
        notifDropdown2.classList.add('open');
      } else {
        notifDropdown2.classList.remove('open');
      }
    });

    profileBtn2.addEventListener('click', (e) => {
      e.stopPropagation();
      const opening = !profileDropdown2.classList.contains('open');
      notifDropdown2.classList.remove('open');
      if (opening) {
        positionDropdown2(profileDropdown2, profileBtn2);
        profileDropdown2.classList.add('open');
      } else {
        profileDropdown2.classList.remove('open');
      }
    });

    document.addEventListener('click', () => {
      notifDropdown2.classList.remove('open');
      profileDropdown2.classList.remove('open');
    });

    // ── Guard: cuma Hero yang boleh nambah produk ──
    const isHero = localStorage.getItem('isHero') === '1';
    document.getElementById(isHero ? 'tambahProdukContent' : 'belumHeroNotice').style.display = 'block';

    // ── Preview nama file foto produk ──
    let produkFotoDataUrl = '';
    const produkFotoInput = document.getElementById('produkFotoInput');
    produkFotoInput.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (!file) return;
      document.getElementById('produkFotoLabel').textContent = 'Terpilih: ' + file.name;
      const reader = new FileReader();
      reader.onload = (ev) => { produkFotoDataUrl = ev.target.result; };
      reader.readAsDataURL(file);
    });

    // ── Validasi field wajib (border merah + reset otomatis saat diisi) ──
    function validateRequiredFields(form) {
      let isValid = true;
      form.querySelectorAll('input[required], select[required], textarea[required]').forEach((field) => {
        const isEmpty = field.type === 'checkbox' ? !field.checked : !field.value.trim();
        if (isEmpty) {
          isValid = false;
          field.style.border = '1.5px solid #ef4444';
          const resetBorder = () => { field.style.border = '1.5px solid rgba(33, 163, 255, 0.15)'; };
          field.addEventListener('input', resetBorder, { once: true });
          field.addEventListener('change', resetBorder, { once: true });
        }
      });
      return isValid;
    }

    // ── Simpan produk ke localStorage (dummy — belum terhubung backend) ──
    document.getElementById('tambahProdukForm').addEventListener('submit', (e) => {
      e.preventDefault();

      if (!validateRequiredFields(e.target)) {
        alert('Mohon lengkapi semua kolom wajib yang bertanda merah sebelum menyimpan produk.');
        return;
      }

      const produkBaru = {
        nama: document.getElementById('produkNamaInput').value.trim(),
        harga: document.getElementById('produkHargaInput').value,
        kategori: document.getElementById('produkKategoriInput').value,
        deskripsi: document.getElementById('produkDeskripsiInput').value.trim(),
        foto: produkFotoDataUrl,
      };

      const produkList = JSON.parse(localStorage.getItem('tokoProduk') || '[]');
      produkList.push(produkBaru);
      localStorage.setItem('tokoProduk', JSON.stringify(produkList));

      alert('Produk "' + produkBaru.nama + '" berhasil ditambahkan ke toko kamu!');
      window.location.href = '/toko-saya';
    });
  </script>
</body>
</html>
