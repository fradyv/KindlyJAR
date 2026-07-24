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

      @include('partials.dashboard-sidebar-extras')
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

    <main class="dash-scroll">
      <div class="dash-main-card">

        @unless($shop)
        <section class="dash-section">
          <h2 class="dash-card-title">Kamu Belum Punya Toko</h2>
          <p class="dash-card-sub">Daftar jadi Hero dulu buat bisa nambah produk jualan di KindlyShop.</p>
          <a href="{{ route('gabung-hero') }}" class="btn-hero inisiasi-cta-btn">Gabung Jadi Hero</a>
        </section>
        @else
        <section class="dash-section">
          <h2 class="dash-card-title">Tambah Produk Baru</h2>
          <p class="dash-card-sub">Isi detail produk yang mau kamu jual di KindlyShop.</p>

          @if ($errors->any())
            <div class="verification-banner" style="background:#fef2f2;border-color:#fecaca;margin-bottom:16px;">
              <div class="banner-content">
                <span class="banner-icon">⚠️</span>
                <p>{{ $errors->first() }}</p>
              </div>
            </div>
          @endif

          @php
            $categories = ['Desain Poster', 'Ilustrasi Digital', 'Desain Web', 'Aset 3D', 'Desain Logo', 'Stok Foto'];
            $draftVal = fn (string $key, mixed $default = '') => old($key, $draft[$key] ?? $default);
            $hasDraftAsset = filled($draft['asset_path'] ?? null);
            $hasDraftPhoto = filled($draft['photo_path'] ?? null);
          @endphp

          <form id="productCreateForm" method="POST" action="{{ route('tambah-produk.store') }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="form-grid-2">
              <div class="form-group">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="title" class="form-input-style" placeholder="Contoh: Poster Ilustrasi Senja" value="{{ $draftVal('title') }}" required />
              </div>
              <div class="form-group">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="price" class="form-input-style" placeholder="Contoh: 25000" min="0" value="{{ $draftVal('price') }}" required />
              </div>
              <div class="form-group">
                <label class="form-label">Kategori Produk</label>
                <select name="category" class="form-input-style" required>
                  <option value="" disabled {{ $draftVal('category') ? '' : 'selected' }}>Pilih kategori produk...</option>
                  @foreach ($categories as $cat)
                    <option value="{{ $cat }}" @selected($draftVal('category') === $cat)>{{ $cat }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">Stok</label>
                <input type="number" name="stock" class="form-input-style" placeholder="Contoh: 100" min="0" value="{{ $draftVal('stock', 0) }}" />
              </div>
              <div class="form-group full-width">
                <label class="form-label">Program Donasi yang Didukung</label>
                <select name="campaign_id" class="form-input-style" required>
                  <option value="" disabled {{ $draftVal('campaign_id') ? '' : 'selected' }}>Pilih program donasi...</option>
                  @foreach($campaigns as $campaign)
                    <option value="{{ $campaign->id }}" @selected((string) $draftVal('campaign_id') === (string) $campaign->id)>{{ $campaign->title }}</option>
                  @endforeach
                </select>
                <span class="form-hint">Hasil penjualan produk ini akan tercatat mendukung program yang kamu pilih.</span>
              </div>
              <div class="form-group full-width">
                <label class="form-label">Deskripsi Produk</label>
                <textarea name="description" class="form-input-style" rows="3" placeholder="Ceritain produk kamu..." required>{{ $draftVal('description') }}</textarea>
              </div>
              <div class="form-group full-width">
                <label class="form-label">Upload Foto Produk <span style="color:#b0b7c3;font-weight:500;">(Preview di KindlyShop)</span></label>
                <div class="custom-file-upload">
                  <span class="upload-icon-style">🖼️</span>
                  <span class="upload-text-main" id="produkFotoLabel">{{ $hasDraftPhoto ? 'File berhasil diunggah' : 'Pilih Foto Produk' }}</span>
                  <span class="upload-text-sub">Format: JPG, PNG max 5MB</span>
                  <input type="file" name="photo" id="produkFotoInput" accept="image/*" />
                  @if ($hasDraftPhoto)
                    <span class="draft-file-hint" data-field="photo" style="display:block;margin-top:6px;font-size:.85rem;color:#22c55e;">Tersimpan: {{ $draft['photo_original_name'] ?? basename($draft['photo_path']) }}</span>
                  @endif
                </div>
              </div>
              <div class="form-group full-width">
                <label class="form-label">Upload Aset Digital <span style="color:#ef4444;">*</span></label>
                <div class="custom-file-upload">
                  <span class="upload-icon-style">📦</span>
                  <span class="upload-text-main" id="produkAsetLabel">{{ $hasDraftAsset ? 'File berhasil diunggah' : 'Pilih File Aset untuk Pembeli' }}</span>
                  <span class="upload-text-sub">Format: PDF, ZIP, PNG, JPG, PPT, PPTX, DOC, DOCX (max 50MB)</span>
                  <input type="file" name="asset" id="produkAsetInput" accept=".pdf,.zip,.png,.jpg,.jpeg,.ppt,.pptx,.doc,.docx" @if(! $hasDraftAsset) required @endif />
                  @if ($hasDraftAsset)
                    <span class="draft-file-hint" data-field="asset" style="display:block;margin-top:6px;font-size:.85rem;color:#22c55e;">Tersimpan: {{ $draft['asset_original_name'] ?? basename($draft['asset_path']) }}</span>
                  @endif
                </div>
                <span class="form-hint">File ini yang bisa didownload pembeli setelah pembayaran berhasil.</span>
              </div>
            </div>

            <div class="form-action-footer">
              <span id="productDraftIndicator" style="font-size:.85rem;color:#b0b7c3;margin-right:auto;display:none;"></span>
              <a href="{{ route('toko-saya') }}" class="btn-form-back">Batal</a>
              <button type="submit" class="btn-form-next">Simpan Produk</button>
            </div>
          </form>
        </section>
        @endunless

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

  @php
    $productCreateDraftConfig = [
      'csrf'       => csrf_token(),
      'draftUrl'   => route('tambah-produk.draft'),
      'draftFileUrl' => route('tambah-produk.draft-file'),
      'draftFiles' => [
        'photo' => $draft['photo_original_name'] ?? null,
        'asset' => $draft['asset_original_name'] ?? null,
      ],
    ];
  @endphp
  <script>
    window.productCreateDraftConfig = @json($productCreateDraftConfig);
  </script>
  <script src="{{ asset('global/script.js') }}"></script>
  @include('partials.dash-dropdown-script')
  <script>
    (function () {
      const form = document.getElementById('productCreateForm');
      if (!form) return;

      const config = window.productCreateDraftConfig || {};
      const draftFiles = { ...(config.draftFiles || {}) };
      const indicator = document.getElementById('productDraftIndicator');
      const draftFields = ['title', 'price', 'category', 'stock', 'campaign_id', 'description'];
      let saveTimer = null;

      function setIndicator(text, color = '#b0b7c3') {
        if (!indicator) return;
        indicator.textContent = text;
        indicator.style.color = color;
        indicator.style.display = text ? 'inline' : 'none';
      }

      function collectDraftPayload() {
        const data = {};
        draftFields.forEach((name) => {
          const el = form.querySelector(`[name="${name}"]`);
          if (el) data[name] = el.value;
        });
        return data;
      }

      function scheduleDraftSave() {
        clearTimeout(saveTimer);
        saveTimer = setTimeout(() => {
          setIndicator('Menyimpan draf...', '#21A3FF');
          fetch(config.draftUrl, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': config.csrf,
            },
            body: JSON.stringify(collectDraftPayload()),
          })
            .then(async (res) => {
              if (!res.ok) {
                const body = await res.json().catch(() => ({}));
                throw new Error(body.message || 'Gagal menyimpan draf.');
              }
              setIndicator('Draf tersimpan', '#22c55e');
              setTimeout(() => setIndicator(''), 2500);
            })
            .catch((err) => setIndicator(err.message || 'Gagal menyimpan draf', '#ef4444'));
        }, 700);
      }

      draftFields.forEach((name) => {
        const el = form.querySelector(`[name="${name}"]`);
        el?.addEventListener('input', scheduleDraftSave);
        el?.addEventListener('change', scheduleDraftSave);
      });

      function updateDraftHint(field, filename) {
        const input = form.querySelector(`#produk${field === 'photo' ? 'Foto' : 'Aset'}Input`);
        const upload = input?.closest('.custom-file-upload');
        if (!upload) return;

        let hint = upload.querySelector(`.draft-file-hint[data-field="${field}"]`);
        if (!hint) {
          hint = document.createElement('span');
          hint.className = 'draft-file-hint';
          hint.dataset.field = field;
          hint.style.cssText = 'display:block;margin-top:6px;font-size:.85rem;color:#22c55e;';
          upload.appendChild(hint);
        }
        hint.textContent = filename ? `Tersimpan: ${filename}` : '';
        hint.style.display = filename ? 'block' : 'none';
      }

      function restoreDraftFileUi() {
        Object.entries(draftFiles).forEach(([field, filename]) => {
          if (!filename) return;
          const labelId = field === 'photo' ? 'produkFotoLabel' : 'produkAsetLabel';
          const inputId = field === 'photo' ? 'produkFotoInput' : 'produkAsetInput';
          const label = document.getElementById(labelId);
          const input = document.getElementById(inputId);
          if (label) {
            label.textContent = 'File berhasil diunggah';
            label.style.color = '#22c55e';
          }
          if (field === 'asset' && input) input.removeAttribute('required');
          updateDraftHint(field, filename);
        });
      }

      async function uploadDraftFile(field, file) {
        const fd = new FormData();
        fd.append('field', field);
        fd.append('file', file);
        fd.append('_token', config.csrf);

        const res = await fetch(config.draftFileUrl, {
          method: 'POST',
          headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': config.csrf },
          body: fd,
        });

        const body = await res.json().catch(() => ({}));
        if (!res.ok) throw new Error(body.message || 'Gagal mengunggah file.');
        return body;
      }

      function bindFileInput(inputId, labelId, field) {
        const input = document.getElementById(inputId);
        const label = document.getElementById(labelId);
        if (!input || !label) return;

        if (!label.dataset.defaultText) label.dataset.defaultText = label.textContent;

        input.addEventListener('change', async () => {
          const file = input.files[0];
          if (!file) return;

          label.textContent = 'Mengunggah...';
          label.style.color = '#21A3FF';

          try {
            const result = await uploadDraftFile(field, file);
            draftFiles[field] = result.filename;
            label.textContent = 'File berhasil diunggah';
            label.style.color = '#22c55e';
            if (field === 'asset') input.removeAttribute('required');
            updateDraftHint(field, result.filename);
          } catch (err) {
            alert(err.message || 'Gagal mengunggah file.');
            input.value = '';
            label.textContent = label.dataset.defaultText;
            label.style.color = '';
          }
        });
      }

      restoreDraftFileUi();
      bindFileInput('produkFotoInput', 'produkFotoLabel', 'photo');
      bindFileInput('produkAsetInput', 'produkAsetLabel', 'asset');
    })();
  </script>
</body>
</html>
