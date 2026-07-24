<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar · KindlyJAR</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('global/style.css') }}"/>
</head>
<body class="auth-body">

  <main class="auth-card">
    <!-- logo (reuse style navbar) -->
    <a class="logo auth-logo" href="{{ route('home') }}">
      <div class="logo-icon">
        <img src="{{ asset('assets/logo_putih.png') }}" alt="KindlyJAR toples" />
      </div>
      <span class="logo-name">KindlyJAR</span>
    </a>

    <h1 class="auth-title">Saatnya Bergerak Bersama!</h1>
    <p class="auth-sub">Buat akun dan mulai jejak kebaikanmu.</p>

    @if ($errors->any())
      <div style="background:#fef2f2;color:#ef4444;border-radius:10px;padding:10px 14px;font-size:0.875rem;margin-bottom:16px;">
        {{ $errors->first() }}
      </div>
    @endif

  <form class="auth-form" method="POST" action="{{ route('register') }}" id="signupForm">
    @csrf
    <label class="auth-field">
      <span>Nama Lengkap</span>
      <input type="text" name="legal_name" id="signupNama" value="{{ old('legal_name') }}" placeholder="Nama kamu" autocomplete="name" required />
      <span class="form-hint" style="color:#9aa1b3;font-size:0.75rem;">Nama ini tidak dapat diubah setelah pendaftaran.</span>
    </label>

    <label class="auth-field">
      <span>Email</span>
      <input type="email" name="email" id="signupEmail" value="{{ old('email') }}" placeholder="nama@email.com" autocomplete="email" required />
    </label>

      <label class="auth-field">
        <span>Password</span>
        <input type="password" name="password" placeholder="Buat password" autocomplete="new-password" required minlength="8" />
      </label>

      <label class="auth-field">
        <span>Konfirmasi Password</span>
        <input type="password" name="password_confirmation" placeholder="Ulangi password" autocomplete="new-password" required minlength="8" />
      </label>

      <label class="auth-remember">
        <input type="checkbox" required /> Saya setuju dengan Syarat &amp; Ketentuan
      </label>

      <button type="submit" class="auth-btn">Daftar</button>
    </form>

    <div class="auth-divider"><span>atau</span></div>

    <button class="auth-google">
      <svg viewBox="0 0 48 48" aria-hidden="true">
        <path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3c-1.6 4.7-6.1 8-11.3 8-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.6 4.1 29.6 2 24 2 12.9 2 4 10.9 4 22s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.7-.4-3.5z"/>
        <path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.7 16 19 13 24 13c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.6 4.1 29.6 2 24 2 16.3 2 9.7 6.3 6.3 14.7z"/>
        <path fill="#4CAF50" d="M24 42c5.5 0 10.4-2.1 14.1-5.5l-6.5-5.5c-2 1.5-4.6 2.5-7.6 2.5-5.2 0-9.6-3.3-11.2-8l-6.5 5C9.6 37.7 16.2 42 24 42z"/>
        <path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-.8 2.3-2.2 4.2-4.2 5.5l6.5 5.5C41.6 35.8 44 30.3 44 24c0-1.3-.1-2.7-.4-3.5z"/>
      </svg>
      Daftar dengan Google
    </button>

    <p class="auth-footer">
      Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a>
    </p>
  </main>

  <script src="{{ asset('global/script.js') }}"></script>
</body>
</html>
