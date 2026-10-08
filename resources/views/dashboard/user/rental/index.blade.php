@extends('layouts.user')

@section('title', 'Rental Saya')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">
            <i class="fas fa-file-invoice me-2"></i>Rental Saya
        </h5>
    </div>

    {{-- id="rental-wrapper" dipakai script auto-refresh di bawah --}}
    <div class="card-body p-0" id="rental-wrapper">

        @if($rentals->count())

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Mobil</th>
                            <th>Tanggal Rental</th>
                            <th>Hari</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($rentals as $rental)
                            @php
                                $pembayaran = $rental->pembayaran;
                                $trx = $pembayaran->transaction_status ?? null;

                                $badge = [
                                    'menunggu'   => ['warning', 'Menunggu Persetujuan'],
                                    'disetujui'  => ['info',    'Disetujui'],
                                    'berjalan'   => ['primary', 'Sedang Berjalan'],
                                    'selesai'    => ['success', 'Selesai'],
                                    'dibatalkan' => ['danger',  'Dibatalkan'],
                                ][$rental->status] ?? ['secondary', ucfirst($rental->status)];
                            @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <strong>{{ $rental->mobil->merk ?? '-' }} {{ $rental->mobil->model ?? '' }}</strong><br>
                                    <small class="text-muted">{{ $rental->mobil->no_plat ?? '-' }}</small>
                                </td>

                                <td>
                                    {{ $rental->tanggal_mulai->format('d/m/Y') }}<br>
                                    <small class="text-muted">
                                        s/d {{ $rental->tanggal_selesai->format('d/m/Y') }}
                                    </small>
                                </td>

                                <td>{{ $rental->jumlah_hari }} hari</td>

                                <td>Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</td>

                                <td>
                                    <span class="badge text-bg-{{ $badge[0] }}">{{ $badge[1] }}</span>
                                </td>

                                <td>
                                    @if($rental->status === 'disetujui' && $trx !== 'settlement')
                                        <a href="{{ route('user.pembayaran.show', $rental->id) }}"
                                           class="btn btn-sm btn-success">
                                            Bayar Sekarang
                                        </a>

                                    @elseif($trx === 'settlement')
                                        <span class="badge text-bg-success">Sudah Dibayar</span>

                                    @elseif($trx === 'pending')
                                        <a href="{{ route('user.pembayaran.show', $rental->id) }}"
                                           class="btn btn-sm btn-warning">
                                            Lanjutkan Pembayaran
                                        </a>

                                    @elseif(in_array($trx, ['expire', 'cancel', 'deny']))
                                        <a href="{{ route('user.pembayaran.show', $rental->id) }}"
                                           class="btn btn-sm btn-danger">
                                            Bayar Lagi
                                        </a>

                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else

            <div class="text-center text-muted py-5">
                <i class="fas fa-car fa-3x mb-3"></i>
                <h5>Belum Ada Rental</h5>
                <p>Kamu belum melakukan rental mobil.</p>
                <a href="{{ route('user.mobil.index') }}" class="btn btn-warning fw-semibold">
                    Lihat Mobil
                </a>
            </div>

        @endif

    </div>
</div>

{{-- AUTO REFRESH: ambil ulang halaman ini, ganti isi #rental-wrapper saja --}}
<script>
(function () {
    const wrapper = document.getElementById('rental-wrapper');
    if (!wrapper) return;

    async function refresh() {
        if (document.hidden) return;
        try {
            const res = await fetch(window.location.href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (!res.ok) return;

            const html = await res.text();
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const baru = doc.getElementById('rental-wrapper');

            if (baru) wrapper.innerHTML = baru.innerHTML;
        } catch (e) {}
    }

    setInterval(refresh, 10000);
    document.addEventListener('visibilitychange', function () {
        if (!document.hidden) refresh();
    });
})();
</script>

@endsection