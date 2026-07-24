<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pengaturan Akun ù KindlyJAR</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('global/style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('global/dashboard.css') }}"/>
</head>
<body class="dashboard-body">

  <!-- -- SIDEBAR (khusus Profil & Pengaturan) -- -->
  <aside class="sidebar">
    <div class="sidebar-top">
      <a class="logo sidebar-logo" href="{{ route('home') }}">
        <div class="logo-icon">
          <img src="{{ asset('assets/logo_putih.png') }}" alt="KindlyJAR" />
        </div>
        <span class="logo-name">KindlyJAR</span>
      </a>

      <a href="{{ route('dashboard') }}" class="sidebar-back-link">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <line x1="19" y1="12" x2="5" y2="12"/>
          <polyline points="12 19 5 12 12 5"/>
        </svg>
        Kembali ke Dashboard
      </a>

      <p class="sidebar-label">Akun</p>

      <nav class="sidebar-nav">
        <a href="{{ route('profil') }}" class="sidebar-link">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
          Lihat Profil
        </a>
        <a href="{{ route('pengaturan-akun') }}" class="sidebar-link active">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="3"/>
            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
          </svg>
          Pengaturan
        </a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="sidebar-link sidebar-link-danger" style="border:none;background:none;width:100%;text-align:left;cursor:pointer;font:inherit;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
              <polyline points="16 17 21 12 16 7"/>
              <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Keluar
          </button>
        </form>
      </nav>
    </div>
  </aside>

  <!-- -- KANAN: topbar (tidak scroll) + konten (scroll) -- -->
  <div class="dash-right">

    <div class="dash-topbar">
      <h1 class="dash-greeting">Pengaturan Akun</h1>
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

    @if (auth()->user()->kyc_status === 'unverified')
    <div class="verification-banner" id="verifyBanner">
      <div class="banner-content">
        <span class="banner-icon">??</span>
        <p><strong>Akun Belum Terverifikasi:</strong> Silakan verifikasi identitasmu terlebih dahulu untuk membuka akses penuh penggalangan dana dan donasi secara aman.</p>
      </div>
      <div class="banner-actions">
        <a href="{{ route('verify') }}" class="banner-btn">Verifikasi Sekarang</a>
        <button class="banner-close" id="closeBannerBtn">&times;</button>
      </div>
    </div>
    @endif

    @include('partials.flash-messages')

    <main class="dash-scroll">
      <div class="dash-main-card settings-layout">
        <nav class="settings-sidenav">
          <a href="#informasi-pribadi" class="settings-nav-item active"> Informasi Pribadi</a>
          <a href="#keamanan" class="settings-nav-item"> Keamanan</a>
          <a href="#notifikasi" class="settings-nav-item"> Notifikasi</a>
          <a href="#privasi" class="settings-nav-item"> Privasi</a>
          <a href="#hapus-akun" class="settings-nav-item danger"> Hapus Akun</a>
        </nav>
      <div class="settings-content">
        <!-- -- INFORMASI PRIBADI (KYC) -- -->
        <section class="dash-section" id="informasi-pribadi">
          <h2 class="dash-card-title">Informasi Pribadi</h2>
          <p class="dash-card-sub">Status verifikasi identitas (KYC) akun Anda.</p>

          @php
            $kycBadge = match(auth()->user()->kyc_status) {
              'verified' => ['?', 'Terverifikasi', '#ecfdf5', '#a7f3d0'],
              'pending'  => ['??', 'Sedang Ditinjau', '#fffbeb', '#fde68a'],
              'rejected' => ['??', 'Ditolak', '#fef2f2', '#fecaca'],
              default    => ['??', 'Belum Terverifikasi', '#f0f9ff', '#bae6fd'],
            };
          @endphp

          <div class="inisiasi-status-banner" style="background:{{ $kycBadge[2] }};border-color:{{ $kycBadge[3] }};">
            <span>{{ $kycBadge[0] }}</span>
            <div>
              <strong>Status: {{ $kycBadge[1] }}</strong>
              <p>
                @if (auth()->user()->kyc_status === 'verified')
                  Akunmu sudah terverifikasi penuh dan bisa membuat program donasi sendiri.
                @elseif (auth()->user()->kyc_status === 'pending')
                  Data verifikasimu sedang ditinjau oleh tim kami. Prosesnya biasanya 1-2 hari kerja.
                @elseif (auth()->user()->kyc_status === 'rejected')
                  Pengajuan sebelumnya belum bisa disetujui. Silakan ajukan ulang datamu.
                @else
                  Lengkapi verifikasi identitas untuk membuka akses penggalangan dana.
                @endif
              </p>
              @if (in_array(auth()->user()->kyc_status, ['unverified', 'rejected']))
                <a href="{{ route('verify') }}" class="btn-hero inisiasi-cta-btn" style="display:inline-block;text-decoration:none;margin-top:10px;">
                  {{ auth()->user()->kyc_status === 'rejected' ? 'Ajukan Ulang' : 'Mulai Verifikasi' }}
                </a>
              @endif
            </div>
          </div>
        </section>

        <!-- -- KEAMANAN -- -->
        <section class="dash-section" id="keamanan" style="display:none">
          <h2 class="dash-card-title">Keamanan</h2>
          <p class="dash-card-sub">Ganti password akun dan aktifkan lapisan keamanan tambahan.</p>

          @if ($errors->has('current_password') || $errors->has('password'))
            <div class="verification-banner" style="background:#fef2f2;border-color:#fecaca;margin-bottom:16px;">
              <div class="banner-content">
                <span class="banner-icon">??</span>
                <p>{{ $errors->first('current_password') ?: $errors->first('password') }}</p>
              </div>
            </div>
          @endif

          <form action="{{ route('pengaturan-akun.password') }}" method="POST" autocomplete="off">
            @csrf
            <div class="form-grid-2">
              <div class="form-group full-width">
                <label class="form-label">Password Saat Ini</label>
                <input type="password" name="current_password" class="form-input-style" placeholder="Masukkan password saat ini" required />
              </div>
              <div class="form-group">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-input-style" placeholder="Minimal 8 karakter" required minlength="8" />
              </div>
              <div class="form-group">
                <label class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-input-style" placeholder="Ulangi password baru" required minlength="8" />
              </div>
            </div>
            <div class="section-save-row">
              <button type="submit" class="btn-form-next">Ubah Password</button>
            </div>
          </form>

          <form action="{{ route('pengaturan-akun.2fa') }}" method="POST">
            @csrf
            <div class="toggle-row">
              <div>
                <p class="toggle-row-title">Autentikasi Dua Faktor (2FA)</p>
                <p class="toggle-row-desc">Tambahkan lapisan keamanan berupa kode OTP setiap kali login dari perangkat baru.</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" name="enable_2fa" value="1" id="twoFaToggle" onchange="this.form.requestSubmit()" @checked($settings->enable_2fa) />
                <span class="toggle-slider"></span>
              </label>
            </div>
          </form>
        </section>

        <!-- -- NOTIFIKASI -- -->
        <section class="dash-section" id="notifikasi" style="display:none">
          <h2 class="dash-card-title">Notifikasi</h2>
          <p class="dash-card-sub">Atur notifikasi email dan push untuk update program, donasi, dan lainnya.</p>

          @php $notif = $settings->notification_preferences ?? []; @endphp

          <form action="{{ route('pengaturan-akun.notifikasi') }}" method="POST">
            @csrf
            <div class="notif-pref-table">
              <div class="notif-pref-row">
                <p class="notif-pref-label">Update Program Donasi</p>
                <div class="notif-pref-channels">
                  <div class="notif-pref-channel">
                    <label class="toggle-switch small"><input type="checkbox" name="notif[program_email]" value="1" @checked($notif['program_email'] ?? true) /><span class="toggle-slider"></span></label>
                    <span>Email</span>
                  </div>
                  <div class="notif-pref-channel">
                    <label class="toggle-switch small"><input type="checkbox" name="notif[program_push]" value="1" @checked($notif['program_push'] ?? true) /><span class="toggle-slider"></span></label>
                    <span>Push</span>
                  </div>
                </div>
              </div>
              <div class="notif-pref-row">
                <p class="notif-pref-label">Donasi & Riwayat Transaksi</p>
                <div class="notif-pref-channels">
                  <div class="notif-pref-channel">
                    <label class="toggle-switch small"><input type="checkbox" name="notif[transaksi_email]" value="1" @checked($notif['transaksi_email'] ?? true) /><span class="toggle-slider"></span></label>
                    <span>Email</span>
                  </div>
                  <div class="notif-pref-channel">
                    <label class="toggle-switch small"><input type="checkbox" name="notif[transaksi_push]" value="1" @checked($notif['transaksi_push'] ?? true) /><span class="toggle-slider"></span></label>
                    <span>Push</span>
                  </div>
                </div>
              </div>
              <div class="notif-pref-row">
                <p class="notif-pref-label">Promo & Info KindlyShop</p>
                <div class="notif-pref-channels">
                  <div class="notif-pref-channel">
                    <label class="toggle-switch small"><input type="checkbox" name="notif[promo_email]" value="1" @checked($notif['promo_email'] ?? false) /><span class="toggle-slider"></span></label>
                    <span>Email</span>
                  </div>
                  <div class="notif-pref-channel">
                    <label class="toggle-switch small"><input type="checkbox" name="notif[promo_push]" value="1" @checked($notif['promo_push'] ?? false) /><span class="toggle-slider"></span></label>
                    <span>Push</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="section-save-row">
              <button type="submit" class="btn-form-next">Simpan Preferensi</button>
            </div>
          </form>
        </section>

        <!-- -- PRIVASI -- -->
        <section class="dash-section" id="privasi" style="display:none">
          <h2 class="dash-card-title">Privasi</h2>
          <p class="dash-card-sub">Atur izin penggunaan data pribadi dan preferensi privasi akun Anda.</p>

          @php $privacy = $settings->privacy_permissions ?? []; @endphp

          <form action="{{ route('pengaturan-akun.privasi') }}" method="POST">
            @csrf
            <div class="toggle-row" style="border-top:none; padding-top:0;">
              <div>
                <p class="toggle-row-title">Tampilkan Profil ke Publik</p>
                <p class="toggle-row-desc">Profil dan riwayat kontribusi Anda dapat dilihat oleh pengguna lain di KindlyJAR.</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" name="privacy[profil_publik]" value="1" @checked($privacy['profil_publik'] ?? true) />
                <span class="toggle-slider"></span>
              </label>
            </div>
            <div class="toggle-row">
              <div>
                <p class="toggle-row-title">Izinkan Penggunaan Data untuk Rekomendasi Program</p>
                <p class="toggle-row-desc">Data aktivitas donasi Anda digunakan untuk merekomendasikan program yang relevan.</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" name="privacy[rekomendasi]" value="1" @checked($privacy['rekomendasi'] ?? true) />
                <span class="toggle-slider"></span>
              </label>
            </div>
            <div class="toggle-row">
              <div>
                <p class="toggle-row-title">Bagikan Data ke Mitra Donasi Terverifikasi</p>
                <p class="toggle-row-desc">Mitra penggalang dana terverifikasi dapat melihat ringkasan kontribusi Anda untuk keperluan pelaporan.</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" name="privacy[bagikan_mitra]" value="1" @checked($privacy['bagikan_mitra'] ?? false) />
                <span class="toggle-slider"></span>
              </label>
            </div>
            <div class="section-save-row">
              <button type="submit" class="btn-form-next">Simpan Preferensi Privasi</button>
            </div>
          </form>
        </section>

        <!-- -- HAPUS / NONAKTIFKAN AKUN -- -->
        <section class="dash-section" id="hapus-akun" style="display:none">
          <h2 class="dash-card-title">Hapus / Nonaktifkan Akun</h2>
          <div class="danger-zone" style="margin-top:16px;">
            <p class="danger-zone-title">Zona Berbahaya</p>
            <p class="danger-zone-desc">Tindakan berikut bersifat sensitif. Menonaktifkan akun akan menyembunyikan profil dan riwayat Anda untuk sementara waktu, sedangkan menghapus akun bersifat permanen dan tidak dapat dibatalkan.</p>
            <div class="danger-zone-actions">
              <form action="{{ route('pengaturan-akun.nonaktifkan') }}" method="POST" onsubmit="return confirm('Yakin ingin menonaktifkan akunmu? Kamu bisa mengaktifkannya lagi dengan login ulang.');">
                @csrf
                <button type="submit" class="btn-danger-outline">Nonaktifkan Akun</button>
              </form>
              <button type="button" class="btn-danger-solid" id="btnDeleteAccount">Hapus Akun Permanen</button>
            </div>
          </div>
        </section>
      </div>
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
    document.getElementById('btnDeleteAccount')?.addEventListener('click', () => {
      alert('Fitur hapus akun permanen belum tersedia. Silakan hubungi tim KindlyJAR untuk permintaan ini.');
    });
  </script>
</body>
</html>
