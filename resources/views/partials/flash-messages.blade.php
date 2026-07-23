@if (session('success'))
  <div class="verification-banner" style="background:#ecfdf5;border-color:#a7f3d0;">
    <div class="banner-content">
      <span class="banner-icon">✅</span>
      <p>{{ session('success') }}</p>
    </div>
  </div>
@endif
@if (session('error'))
  <div class="verification-banner" style="background:#fef2f2;border-color:#fecaca;">
    <div class="banner-content">
      <span class="banner-icon">⚠️</span>
      <p>{{ session('error') }}</p>
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
