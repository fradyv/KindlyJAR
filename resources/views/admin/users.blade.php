<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kelola Pengguna · KindlyJAR</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('global/style.css') }}"/>
  <link rel="stylesheet" href="{{ asset('global/dashboard.css') }}"/>
</head>
<body class="dashboard-body">

  @include('partials.admin-sidebar')

  <div class="dash-right">
    @include('partials.admin-topbar', ['pageTitle' => 'Kelola Pengguna'])

    @include('partials.flash-messages')

    <main class="dash-scroll">
      <div class="dash-main-card">
        <section class="dash-section">
          <h2 class="dash-card-title">Semua Pengguna</h2>
          <p class="dash-card-sub">Kelola status aktif akun dan lihat peran setiap pengguna.</p>

          <form method="GET" action="{{ route('admin.users') }}" style="margin-bottom:16px;max-width:360px;">
            <input type="text" name="search" class="form-input-style" placeholder="Cari nama atau email..." value="{{ $search }}" />
          </form>

          <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
              <thead>
                <tr style="text-align:left;border-bottom:1px solid #eef1f6;">
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Nama</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Email</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Peran</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Status KYC</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Status Akun</th>
                  <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;"></th>
                </tr>
              </thead>
              <tbody>
                @forelse ($users as $user)
                  @php
                    $kycColor = match($user->kyc_status) {
                      'verified' => ['bg' => '#e6f9ee', 'text' => '#1a7d43'],
                      'pending' => ['bg' => '#fff7e6', 'text' => '#b7791f'],
                      'rejected' => ['bg' => '#fdecea', 'text' => '#b3261e'],
                      default => ['bg' => '#eef1f6', 'text' => '#6b7a8d'],
                    };
                    $kycLabel = match($user->kyc_status) {
                      'verified' => 'Terverifikasi',
                      'pending' => 'Menunggu',
                      'rejected' => 'Ditolak',
                      default => 'Belum Verifikasi',
                    };
                  @endphp
                  <tr style="border-bottom:1px solid #f5f7fa;">
                    <td style="padding:10px 8px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;">{{ $user->display_name }}</td>
                    <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">{{ $user->email }}</td>
                    <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">
                      @forelse ($user->roles as $role)
                        <span style="display:inline-block;padding:3px 9px;border-radius:999px;background:#eef4ff;color:#21A3FF;font-family:'Nunito',sans-serif;font-weight:700;font-size:.72rem;margin-right:4px;">{{ ucfirst(str_replace('_', ' ', $role->name)) }}</span>
                      @empty
                        &mdash;
                      @endforelse
                    </td>
                    <td style="padding:10px 8px;">
                      <span style="display:inline-block;padding:4px 10px;border-radius:999px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.75rem;background:{{ $kycColor['bg'] }};color:{{ $kycColor['text'] }};">{{ $kycLabel }}</span>
                    </td>
                    <td style="padding:10px 8px;">
                      <span style="display:inline-block;padding:4px 10px;border-radius:999px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.75rem;background:{{ $user->is_active ? '#e6f9ee' : '#fdecea' }};color:{{ $user->is_active ? '#1a7d43' : '#b3261e' }};">{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                    </td>
                    <td style="padding:10px 8px;">
                      @unless ($user->isAdmin())
                        <form method="POST" action="{{ route('admin.users.toggle-active', $user) }}">
                          @csrf
                          <button type="submit" class="{{ $user->is_active ? 'btn-danger-outline' : 'btn-success-solid' }}" style="padding:6px 12px;font-size:.75rem;">
                            {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                          </button>
                        </form>
                      @endunless
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="6" style="padding:16px 8px;text-align:center;color:#94a3b8;">Tidak ada pengguna ditemukan.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </main>
  </div>
</body>
</html>
