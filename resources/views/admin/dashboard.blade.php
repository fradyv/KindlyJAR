@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('pageTitle', 'Dashboard Admin')

@section('content')
      <div class="dash-main-card">

        <section class="dash-section">
          <h2 class="dash-card-title">Ringkasan Platform</h2>
          <p class="dash-card-sub">Statistik singkat aktivitas KindlyJAR saat ini.</p>
          <div class="summary-row">
            <div class="summary-card">
              <p class="summary-value">{{ $stats['total_users'] }}</p>
              <p class="summary-label">Total Pengguna</p>
            </div>
            <div class="summary-card">
              <p class="summary-value">{{ $stats['total_fundraisers'] }}</p>
              <p class="summary-label">Total Fundraiser</p>
            </div>
            <div class="summary-card">
              <p class="summary-value">{{ $stats['pending_kyc'] }}</p>
              <p class="summary-label">KYC Menunggu Verifikasi</p>
            </div>
            <div class="summary-card">
              <p class="summary-value">{{ $stats['pending_withdrawals'] }}</p>
              <p class="summary-label">Pencairan Menunggu</p>
            </div>
          </div>
          <div class="summary-row" style="margin-top:16px;">
            <div class="summary-card">
              <p class="summary-value">Rp {{ number_format($stats['total_collected'], 0, ',', '.') }}</p>
              <p class="summary-label">Total Dana Terkumpul</p>
            </div>
            <div class="summary-card">
              <p class="summary-value">Rp {{ number_format($stats['total_withdrawn'], 0, ',', '.') }}</p>
              <p class="summary-label">Total Dana Tersalurkan</p>
            </div>
            <div class="summary-card">
              <p class="summary-value">{{ $stats['total_transactions'] }}</p>
              <p class="summary-label">Transaksi Sukses</p>
            </div>
          </div>
        </section>

        <section class="dash-section">
          <h2 class="dash-card-title">Verifikasi KYC Menunggu</h2>
          @if ($latestVerifications->isEmpty())
            <p class="shop-empty-state">Tidak ada pengajuan KYC yang menunggu.</p>
          @else
            <div style="overflow-x:auto;">
              <table style="width:100%;border-collapse:collapse;">
                <thead>
                  <tr style="text-align:left;border-bottom:1px solid #eef1f6;">
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Nama</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Tipe Akun</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Diajukan</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($latestVerifications as $v)
                    <tr style="border-bottom:1px solid #f5f7fa;">
                      <td style="padding:10px 8px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;">{{ $v->user->display_name }}</td>
                      <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">{{ ucfirst(str_replace('_', ' ', $v->account_type)) }}</td>
                      <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">{{ \Carbon\Carbon::parse($v->created_at)->translatedFormat('d M Y') }}</td>
                      <td style="padding:10px 8px;"><a href="{{ route('admin.verifications') }}" class="btn-form-next" style="padding:6px 14px;font-size:.8rem;display:inline-block;">Tinjau</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </section>

        <section class="dash-section">
          <h2 class="dash-card-title">Pencairan Dana Menunggu</h2>
          @if ($latestWithdrawals->isEmpty())
            <p class="shop-empty-state">Tidak ada permintaan pencairan yang menunggu.</p>
          @else
            <div style="overflow-x:auto;">
              <table style="width:100%;border-collapse:collapse;">
                <thead>
                  <tr style="text-align:left;border-bottom:1px solid #eef1f6;">
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Fundraiser</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Jumlah</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;">Diajukan</th>
                    <th style="padding:10px 8px;font-family:'Nunito',sans-serif;font-size:.8rem;color:#6b7a8d;"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($latestWithdrawals as $w)
                    <tr style="border-bottom:1px solid #f5f7fa;">
                      <td style="padding:10px 8px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;">{{ $w->wallet->user->display_name }}</td>
                      <td style="padding:10px 8px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.85rem;">Rp {{ number_format($w->amount, 0, ',', '.') }}</td>
                      <td style="padding:10px 8px;font-family:'Open Sans',sans-serif;font-size:.85rem;">{{ $w->created_at->translatedFormat('d M Y') }}</td>
                      <td style="padding:10px 8px;"><a href="{{ route('admin.withdrawals') }}" class="btn-form-next" style="padding:6px 14px;font-size:.8rem;display:inline-block;">Tinjau</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </section>

      </div>
@endsection
