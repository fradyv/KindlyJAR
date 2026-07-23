@if (auth()->user()->kyc_status !== 'verified')
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
@endif
