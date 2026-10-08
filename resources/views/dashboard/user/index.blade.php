@extends('layouts.user')

@section('title', 'Dashboard User')

@section('content')

{{-- WELCOME --}}
<div class="card bg-dark text-white border-0 border-bottom border-warning border-4 shadow-sm mb-4">
    <div class="card-body p-4 d-flex align-items-center justify-content-between gap-3">

        <div>
            <span class="badge text-bg-warning mb-3">
                <i class="fas fa-circle me-1" style="font-size:6px; vertical-align:middle;"></i> Akun Aktif
            </span>

            <h3 class="fw-bold mb-1">Selamat Datang</h3>
            <p class="text-white-50 mb-3">Silakan pilih mobil yang ingin kamu rental.</p>

            <a href="{{ route('user.mobil.index') }}" class="btn btn-warning fw-semibold">
                <i class="fas fa-car me-1"></i> Lihat Mobil
            </a>
        </div>

        <i class="fas fa-car-side text-warning d-none d-md-block opacity-75" style="font-size:5rem;"></i>

    </div>
</div>

{{-- STATISTIK --}}
{{-- Angka diambil dari controller: $totalRental, $rentalAktif, $rentalSelesai --}}
<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle bg-dark text-warning d-flex align-items-center justify-content-center"
                     style="width:46px; height:46px;">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold lh-1">{{ $totalRental ?? 0 }}</div>
                    <small class="text-muted">Total Rental</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle bg-dark text-warning d-flex align-items-center justify-content-center"
                     style="width:46px; height:46px;">
                    <i class="fas fa-key"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold lh-1">{{ $rentalAktif ?? 0 }}</div>
                    <small class="text-muted">Rental Aktif</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-circle bg-dark text-warning d-flex align-items-center justify-content-center"
                     style="width:46px; height:46px;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold lh-1">{{ $rentalSelesai ?? 0 }}</div>
                    <small class="text-muted">Rental Selesai</small>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- AKSES CEPAT --}}
<h6 class="text-uppercase text-muted fw-bold mb-3">Akses Cepat</h6>

<div class="list-group list-group-horizontal-md shadow-sm">

    <a href="{{ route('user.mobil.index') }}"
       class="list-group-item list-group-item-action py-3">
        <i class="fas fa-car me-2 text-warning"></i>
        <strong>Daftar Mobil</strong><br>
        <small class="text-muted">Cari & rental mobil baru</small>
    </a>

    <a href="{{ route('user.rental.index') }}"
       class="list-group-item list-group-item-action py-3">
        <i class="fas fa-file-invoice me-2 text-warning"></i>
        <strong>Rental Saya</strong><br>
        <small class="text-muted">Riwayat & status booking</small>
    </a>

    <a href="{{ route('user.profil') }}"
       class="list-group-item list-group-item-action py-3">
        <i class="fas fa-user me-2 text-warning"></i>
        <strong>Profil Saya</strong><br>
        <small class="text-muted">Kelola data akun</small>
    </a>

</div>

@endsection