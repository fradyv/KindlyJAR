<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pencairan Dana · KindlyJAR</title>
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

      @include('partials.dashboard-sidebar-extras')
    </div>
  </aside>

  <!-- ── KANAN: topbar (tidak scroll) + konten (scroll) ── -->
  <div class="dash-right">

    <div class="dash-topbar">
      <h1 class="dash-greeting">Pencairan Dana</h1>
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

    @include('partials.flash-messages')

    <main class="dash-scroll">
      <div class="dash-main-card">

        <section class="dash-section">
          <h2 class="dash-card-title">Ringkasan Saldo</h2>
          <p class="dash-card-sub">Saldo terkumpul dari seluruh program donasi yang kamu buat.</p>
          <div class="summary-row">
            <div class="summary-card">
              <p class="summary-value">Rp {{ number_format($totalAvailable, 0, ',', '.') }}</p>
              <p class="summary-label">Total Saldo Terkumpul</p>
            </div>
            <div class="summary-card">
              <p class="summary-value">Rp {{ number_format($pendingAmount, 0, ',', '.') }}</p>
              <p class="summary-label">Menunggu Persetujuan</p>
            </div>
            <div class="summary-card">
              <p class="summary-value">Rp {{ number_format($withdrawable, 0, ',', '.') }}</p>
              <p class="summary-label">Bisa Dicairkan Sekarang</p>
            </div>
          </div>
        </section>

        @if ($campaigns->isNotEmpty())
        <section class="dash-section">
          <h2 class="dash-card-title">Rincian per Program Donasi</h2>
          <div class="inisiasi-why-grid">
            @foreach ($campaigns as $campaign)
              <div class="inisiasi-why-card">
                <h4>{{ $campaign->title }}</h4>
                <p>
                  Terkumpul Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}
                  &middot; Sudah dicairkan Rp {{ number_format($campaign->withdrawn_amount, 0, ',', '.') }}
                  &middot; Tersedia <strong>Rp {{ number_format($campaign->available_balance, 0, ',', '.') }}</strong>
                </p>
              </div>
            @endforeach
          </div>
        </section>
        @endif

        <section class="dash-section">
          <h2 class="dash-card-title">Ajukan Pencairan Dana</h2>
          <p class="dash-card-sub">Dana akan ditransfer ke rekening/e-wallet yang kamu tuliskan. Permintaan akan ditinjau oleh admin dalam 1-2 hari kerja.</p>

          @if ($errors->any())
            <div class="verification-banner" style="background:#fef2f2;border-color:#fecaca;margin-bottom:16px;">
              <div class="banner-content">
                <span class="banner-icon">⚠️</span>
                <p>{{ $errors->first() }}</p>
              </div>
            </div>
          @endif

          @if ($withdrawable < 50000)
            <p style="color:#94a3b8;font-family:'Open Sans',sans-serif;">Saldo yang bisa dicairkan belum mencukupi (minimal Rp 50.000).</p>
          @else
            <form method="POST" action="{{ route('pencairan-dana.store') }}" autocomplete="off">
              @csrf
              <div class="form-grid-2">
                <div class="form-group">
                  <label class="form-label">Jumlah Pencairan (Rp)</label>
                  <input type="number" name="amount" class="form-input-style" min="50000" max="{{ $withdrawable }}" step="1000" value="{{ old('amount') }}" required />
                  <span class="form-hint">Maksimal Rp {{ number_format($withdrawable, 0, ',', '.') }}</span>
                </div>
                <div class="form-group full-width">
                  <label class="form-label">Rekening / E-Wallet Tujuan</label>
                  <textarea name="bank_or_ewallet_info" class="form-input-style" rows="2" placeholder="Contoh: BCA 1234567890 a.n. {{ auth()->user()->legal_name ?? auth()->user()->display_name }}" required>{{ old('bank_or_ewallet_info') }}</textarea>
                </div>
              </div>
              <div class="form-action-footer" style="justify-content:flex-end;">
                <button type="submit" class="btn-form-next">Ajukan Pencairan</button>
              </div>
            </form>
          @endif
        </section>

        <section class="dash-section">
          <h2 class="dash-card-title">Riwayat Pencairan</h2>

          @if ($requests->isEmpty())
            <p class="shop-empty-state">Belum ada riwayat pencairan dana.</p>
          @else
            <div style="overflow-x:auto;">
              <table class="riwayat-table" style="width:100%;border-collapse:collapse;">
                <thead>
                  <tr style="text-align:left;border-bottom:1px solid #eef1f6;">
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Tanggal</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Jumlah</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Tujuan</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($requests as $req)
                    @php
                      $statusColor = match($req->status) {
                        'approved' => ['bg' => '#e6f9ee', 'text' => '#1a7d43'],
                        'rejected' => ['bg' => '#fdecea', 'text' => '#b3261e'],
                        default    => ['bg' => '#fff7e6', 'text' => '#b7791f'],
                      };
                      $statusLabel = match($req->status) {
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        default    => 'Menunggu',
                      };
                    @endphp
                    <tr style="border-bottom:1px solid #f5f7fa;">
                      <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">{{ $req->created_at->translatedFormat('d M Y, H:i') }}</td>
                      <td style="padding:10px 8px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;">Rp {{ number_format($req->amount, 0, ',', '.') }}</td>
                      <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;max-width:220px;">{{ $req->bank_or_ewallet_info }}</td>
                      <td style="padding:10px 8px;">
                        <span style="display:inline-block;padding:4px 10px;border-radius:999px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.75rem;background:{{ $statusColor['bg'] }};color:{{ $statusColor['text'] }};">{{ $statusLabel }}</span>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
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
