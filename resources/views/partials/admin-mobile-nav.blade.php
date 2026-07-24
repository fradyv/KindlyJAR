@php
  $adminNavItems = [
    ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'match' => 'admin.dashboard'],
    ['route' => 'admin.users', 'label' => 'Kelola Pengguna', 'match' => 'admin.users'],
    ['route' => 'admin.verifications', 'label' => 'Verifikasi KYC', 'match' => 'admin.verifications'],
    ['route' => 'admin.transactions', 'label' => 'Riwayat Transaksi', 'match' => 'admin.transactions'],
    ['route' => 'admin.withdrawals', 'label' => 'Pencairan Dana', 'match' => 'admin.withdrawals'],
    ['route' => 'admin.campaigns', 'label' => 'Penyaluran Donasi', 'match' => 'admin.campaigns'],
  ];
@endphp

<nav class="admin-mobile-nav" id="admin-mobile-nav" aria-label="Menu panel admin">
  <p class="admin-mobile-nav-title">Panel Admin</p>
  @foreach ($adminNavItems as $item)
    <a href="{{ route($item['route']) }}"
       class="admin-mobile-nav-link @if(request()->routeIs($item['match'])) active @endif">
      {{ $item['label'] }}
    </a>
  @endforeach
  <div class="admin-mobile-nav-divider"></div>
  <a href="{{ route('dashboard') }}" class="admin-mobile-nav-link admin-mobile-nav-muted">&larr; Ke Beranda</a>
</nav>

<button type="button" class="admin-hamburger" id="admin-hamburger-btn" aria-label="Buka menu admin">
  <span></span>
  <span></span>
  <span></span>
</button>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('admin-hamburger-btn');
    const nav = document.getElementById('admin-mobile-nav');

    if (!btn || !nav) return;

    btn.addEventListener('click', function () {
      const opening = !nav.classList.contains('open');
      btn.classList.toggle('open', opening);
      nav.classList.toggle('open', opening);
      document.body.classList.toggle('admin-nav-open', opening);
    });

    nav.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        btn.classList.remove('open');
        nav.classList.remove('open');
        document.body.classList.remove('admin-nav-open');
      });
    });
  });
</script>
