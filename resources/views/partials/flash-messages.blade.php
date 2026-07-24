@if (session('success'))
  <div class="verification-banner flash-auto-dismiss" style="background:#ecfdf5;border-color:#a7f3d0;">
    <div class="banner-content">
      <span class="banner-icon">✅</span>
      <p>{{ session('success') }}</p>
    </div>
  </div>
  <script>
    (function () {
      var banner = document.currentScript.previousElementSibling;
      if (!banner || !banner.classList.contains('flash-auto-dismiss')) return;
      setTimeout(function () {
        banner.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
        banner.style.opacity = '0';
        banner.style.transform = 'translateY(-8px)';
        setTimeout(function () { banner.remove(); }, 350);
      }, 5000);
    })();
  </script>
@endif
@if (session('error'))
  <div class="verification-banner" style="background:#fef2f2;border-color:#fecaca;">
    <div class="banner-content">
      <span class="banner-icon">⚠️</span>
      <div>
        <p style="margin:0;">{{ session('error') }}</p>
        @if (session('retry_payment_url'))
          <a href="{{ session('retry_payment_url') }}" style="display:inline-block;margin-top:8px;font-family:'Nunito',sans-serif;font-weight:700;color:#21A3FF;text-decoration:none;">
            Coba bayar lagi →
          </a>
        @endif
      </div>
    </div>
  </div>
@endif
@if ($errors->any())
  <div class="verification-banner" style="background:#fef2f2;border-color:#fecaca;">
    <div class="banner-content">
      <span class="banner-icon">⚠️</span>
      <p>{{ $errors->first() }}</p>
    </div>
  </div>
@endif
