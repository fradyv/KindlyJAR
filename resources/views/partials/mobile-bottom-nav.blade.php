<style>
    /* Pastikan variabel warna ini sudah ada di file CSS utamamu. 
       Kalau belum, ini sebagai fallback-nya. */
    :root {
        --blue-main: #2563eb;
        --white: #ffffff;
        --text-dark: #1f2937;
    }

    /* Tombol Hamburger (Sudah dimodifikasi posisinya ke bawah tengah) */
    .hamburger {
        display: flex; /* Ganti dari none ke flex agar selalu render, nanti disembunyikan pakai media query di desktop */
        position: fixed; /* Menempel di layar */
        bottom: 24px; /* Jarak dari bawah */
        left: 50%;
        transform: translateX(-100%); /* Menarik elemen tepat ke tengah */
        flex-direction: column;
        justify-content: center;
        gap: 5px;
        width: 80px; /* Disesuaikan sedikit agar proporsional sebagai tombol melayang */
        height: 80px;
        background: var(--blue-main);
        border: none;
        border-radius: 12px; /* Bisa diganti 50% kalau mau bulat sempurna */
        cursor: pointer;
        padding: 12px;
        z-index: 200;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15); /* Tambahan shadow biar stand out */
    }

    .hamburger span {
        display: block;
        width: 100%;
        height: 2.5px;
        background: var(--white);
        border-radius: 99px;
        transition: all 0.3s ease;
    }

    .hamburger.open span:nth-child(1) {
        transform: translateY(7.5px) rotate(45deg);
    }
    .hamburger.open span:nth-child(2) {
        opacity: 0;
        transform: scaleX(0);
    }
    .hamburger.open span:nth-child(3) {
        transform: translateY(-7.5px) rotate(-45deg);
    }

    /* Mobile nav overlay (Full Screen) */
    .mobile-nav {
        /* Ganti none jadi flex tapi transparan, agar animasi opacity-nya jalan mulus */
        display: flex; 
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.97);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        z-index: 150;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }

    .mobile-nav.open {
        opacity: 1;
        pointer-events: auto;
    }

    .mobile-nav a {
        font-family: 'Nunito', sans-serif;
        font-weight: 700;
        font-size: 1.4rem;
        color: var(--text-dark);
        text-decoration: none;
        padding: 14px 40px;
        border-radius: 50px;
        transition: background 0.2s, color 0.2s;
    }

    .mobile-nav a:hover {
        background: var(--blue-main);
        color: var(--white);
    }

    .mobile-nav .mobile-nav-divider {
        width: 48px;
        height: 2px;
        background: rgba(33, 163, 255, 0.2);
        border-radius: 99px;
        margin: 8px 0;
    }

    .mobile-nav .btn-signup-mobile {
        background: var(--blue-main);
        color: var(--white) !important;
        margin-top: 8px;
    }

    /* Sembunyikan navigasi mobile ini jika dibuka di layar besar (Desktop) */
    @media (min-width: 768px) {
        .hamburger, .mobile-nav {
            display: none !important;
        }
    }
</style>

<!-- Full Screen Overlay Menu -->
<nav class="mobile-nav" id="mobile-nav">
    <!-- Menu Default (User Biasa) -->
    <a href="{{ route('dashboard') }}">Beranda</a>
    <a href="{{ route('program-donasi') }}">Program Donasi</a>
    <a href="{{ route('kindlyshop') }}">KindlyShop</a>
    <a href="{{ route('riwayat') }}">Riwayat Pembelian</a>
    <a href="{{ route('inisiasi') }}">Inisiasi Donasi</a>
    @unless(auth()->user()->shop)
    <a href="{{ route('gabung-hero') }}" class="btn-join-hero" style="display:inline-block;text-align:center;text-decoration:none;">Gabung menjadi Hero!</a>
    @endunless
    <!-- Menu Extra (Hanya Muncul Jika Admin) -->
    @if(auth()->user()->shop)
        <div class="mobile-nav-divider"></div>
        <a href="{{ route('toko-saya') }}" >Toko Saya</a>
        <a href="{{ route('tambah-produk') }}">Tambah Produk</a>
        <a href="{{ route('produk-terjual') }}">Produk yang Terjual</a>
        <a href="{{ route('pencairan-dana') }}">Pencairan Dana</a>
    @endif
    @if(auth()->user()->isAdmin())
        <a href="{{ route('admin.dashboard') }}">
        Panel Admin
      </a>
    @endif
</nav>

<!-- Tombol Hamburger Bawah Tengah -->
<button class="hamburger" id="hamburger-btn" aria-label="Toggle Menu">
    <span></span>
    <span></span>
    <span></span>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileNav = document.getElementById('mobile-nav');

        // Klik hamburger untuk toggle class 'open'
        hamburgerBtn.addEventListener('click', function() {
            this.classList.toggle('open');
            mobileNav.classList.toggle('open');
        });

        // UX Tambahan: Tutup menu ketika salah satu link diklik
        const navLinks = mobileNav.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                hamburgerBtn.classList.remove('open');
                mobileNav.classList.remove('open');
            });
        });
    });
</script>