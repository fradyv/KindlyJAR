<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Verifikasi KYC · KindlyJAR</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('global/style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('global/dashboard.css') }}"/>
</head>
<body class="dashboard-body">

  @include('partials.admin-sidebar')

  <div class="dash-right">
    @include('partials.admin-topbar', ['pageTitle' => 'Verifikasi KYC'])

    @include('partials.flash-messages')

    <main class="dash-scroll">
      <div class="dash-main-card">
        <section class="dash-section">
          <h2 class="dash-card-title">Pengajuan Verifikasi Fundraiser</h2>
          <p class="dash-card-sub">Tinjau dokumen KYC sebelum menyetujui atau menolak pengajuan.</p>

          <div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap;">
            @foreach (['pending' => 'Menunggu', 'verified' => 'Disetujui', 'rejected' => 'Ditolak', 'all' => 'Semua'] as $key => $label)
              <a href="{{ route('admin.verifications', ['status' => $key]) }}"
                 class="{{ $status === $key ? 'btn-form-next' : 'btn-danger-outline' }}"
                 style="padding:6px 16px;font-size:.8rem;display:inline-block;text-decoration:none;{{ $status !== $key ? 'color:#6b7a8d;border-color:#dfe6ee;' : '' }}">
                {{ $label }}
              </a>
            @endforeach
          </div>

          @if ($verifications->isEmpty())
            <p class="shop-empty-state">Tidak ada pengajuan verifikasi pada kategori ini.</p>
          @else
            <div class="inisiasi-why-grid">
              @foreach ($verifications as $v)
                @php
                  $docs = [
                    'Foto KTP' => $v->ktp_photo,
                    'Foto Selfie + KTP' => $v->selfie_ktp_photo,
                    'Foto Profil' => $v->profile_photo,
                    'Buku Tabungan' => $v->passbook_photo,
                    'Surat Keterangan' => $v->statement_letter,
                    'Dokumen Pendukung' => $v->supporting_docs,
                  ];
                @endphp
                <div class="inisiasi-why-card" style="text-align:left;">
                  <h4>{{ $v->user->display_name }}</h4>
                  <p style="margin-bottom:8px;">
                    {{ ucfirst(str_replace('_', ' ', $v->account_type)) }} &middot; KTP: {{ $v->ktp_number }}<br>
                    {{ $v->bank_name }} &middot; {{ $v->bank_account_number }} a.n. {{ $v->bank_account_name }}<br>
                    Diajukan {{ \Carbon\Carbon::parse($v->created_at)->translatedFormat('d M Y, H:i') }}
                  </p>
                  <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;">
                    @foreach ($docs as $label => $path)
                      @if ($path)
                        <a href="{{ asset($path) }}" target="_blank" rel="noopener" style="font-size:.72rem;padding:4px 10px;border-radius:999px;background:#eef4ff;color:#21A3FF;text-decoration:none;font-family:'Nunito',sans-serif;font-weight:700;">{{ $label }}</a>
                      @endif
                    @endforeach
                  </div>
                  @if ($v->status === 'pending')
                    <div style="display:flex;gap:8px;">
                      <form method="POST" action="{{ route('admin.verifications.approve', $v) }}">
                        @csrf
                        <button type="submit" class="btn-success-solid" style="padding:6px 14px;font-size:.8rem;">Setujui</button>
                      </form>
                      <form method="POST" action="{{ route('admin.verifications.reject', $v) }}">
                        @csrf
                        <button type="submit" class="btn-danger-outline" style="padding:6px 14px;font-size:.8rem;">Tolak</button>
                      </form>
                    </div>
                  @else
                    @php
                      $statusColor = $v->status === 'verified' ? ['bg' => '#e6f9ee', 'text' => '#1a7d43'] : ['bg' => '#fdecea', 'text' => '#b3261e'];
                    @endphp
                    <span style="display:inline-block;padding:4px 10px;border-radius:999px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.75rem;background:{{ $statusColor['bg'] }};color:{{ $statusColor['text'] }};">
                      {{ $v->status === 'verified' ? 'Disetujui' : 'Ditolak' }}
                    </span>
                  @endif
                </div>
              @endforeach
            </div>
          @endif
        </section>
      </div>
    </main>
  </div>
</body>
</html>
