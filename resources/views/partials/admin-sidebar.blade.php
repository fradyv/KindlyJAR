<aside class="sidebar">
  <div class="sidebar-top">
    <a class="logo sidebar-logo" href="{{ route('admin.dashboard') }}">
      <div class="logo-icon">
        <img src="{{ asset('assets/logo_putih.png') }}" alt="KindlyJAR" />
      </div>
      <span class="logo-name">KindlyJAR</span>
    </a>

    <p class="sidebar-label">Panel Admin</p>

    <nav class="sidebar-nav">
      <a href="{{ route('admin.dashboard') }}" class="sidebar-link @if(request()->routeIs('admin.dashboard')) active @endif">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
          <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        Dashboard
      </a>
      <a href="{{ route('admin.users') }}" class="sidebar-link @if(request()->routeIs('admin.users')) active @endif">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
          <circle cx="9" cy="7" r="4"/>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
          <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        Kelola Pengguna
      </a>
      <a href="{{ route('admin.verifications') }}" class="sidebar-link @if(request()->routeIs('admin.verifications')) active @endif">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M9 12l2 2 4-4"/>
          <path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
        </svg>
        Verifikasi KYC
      </a>
      <a href="{{ route('admin.transactions') }}" class="sidebar-link @if(request()->routeIs('admin.transactions')) active @endif">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
          <polyline points="7 10 12 15 17 10"/>
          <line x1="12" y1="15" x2="12" y2="3"/>
        </svg>
        Kelola Transaksi
      </a>
      <a href="{{ route('admin.withdrawals') }}" class="sidebar-link @if(request()->routeIs('admin.withdrawals')) active @endif">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <line x1="12" y1="1" x2="12" y2="23"/>
          <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
        </svg>
        Pencairan Dana
      </a>
      <a href="{{ route('admin.campaigns') }}" class="sidebar-link @if(request()->routeIs('admin.campaigns')) active @endif">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
          <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
        </svg>
        Penyaluran Donasi
      </a>
    </nav>

    <div class="sidebar-cta">
      <a href="{{ route('home') }}" style="display:inline-block;text-align:center;text-decoration:none;color:#6b7a8d;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;">&larr; Ke Beranda Situs</a>
    </div>
  </div>
</aside>
