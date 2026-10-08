@extends('layouts.user')

@section('title', 'Rental Mobil')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-1"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row g-4">

    {{-- FORM --}}
    <div class="col-lg-8">
        <div class="card shadow-sm">

            <div class="card-header bg-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-car me-2"></i>Rental Mobil
                </h5>
            </div>

            <form action="{{ route('user.rental.store') }}" method="POST">
                @csrf

                <input type="hidden" name="mobil_id" value="{{ $mobil->id }}">

                <div class="card-body">

                    {{-- Mobil --}}
                    <div class="mb-3">
                        <label class="form-label">Mobil</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $mobil->merk }} {{ $mobil->model }}"
                               readonly>
                    </div>

                    {{-- Harga --}}
                    <div class="mb-3">
                        <label class="form-label">Harga Per Hari</label>
                        <input type="text"
                               id="harga_display"
                               class="form-control"
                               value="Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}"
                               readonly>
                        <input type="hidden"
                               id="harga_per_hari"
                               value="{{ $mobil->harga_per_hari }}">
                    </div>

                    <div class="row g-3 mb-3">

                        {{-- Tanggal Mulai --}}
                        <div class="col-md-6">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date"
                                   name="tanggal_mulai"
                                   id="tanggal_mulai"
                                   class="form-control @error('tanggal_mulai') is-invalid @enderror"
                                   min="{{ date('Y-m-d') }}"
                                   value="{{ old('tanggal_mulai') }}"
                                   required>
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tanggal Selesai --}}
                        <div class="col-md-6">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                            <input type="date"
                                   name="tanggal_selesai"
                                   id="tanggal_selesai"
                                   class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                   value="{{ old('tanggal_selesai') }}"
                                   required>
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    {{-- Jam Ambil --}}
                    <div class="mb-3">
                        <label for="jam_mulai" class="form-label">Jam Ambil / Kembali</label>
                        <input type="time"
                               name="jam_mulai"
                               id="jam_mulai"
                               class="form-control @error('jam_mulai') is-invalid @enderror"
                               value="{{ old('jam_mulai', '09:00') }}"
                               required>
                        @error('jam_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Mobil harus dikembalikan pada jam yang sama dengan jam ambil, di tanggal selesai.
                        </div>
                    </div>

                    {{-- Jumlah Hari --}}
                    <div class="mb-3">
                        <label class="form-label">Jumlah Hari</label>
                        <input type="text"
                               id="jumlah_hari"
                               class="form-control"
                               value="0 Hari"
                               readonly>
                    </div>

                    {{-- Total Harga --}}
                    <div class="mb-3">
                        <div class="bg-dark text-white rounded p-3">
                            <small class="text-warning text-uppercase">Estimasi Total Pembayaran</small>
                            <div class="fs-3 fw-bold" id="total_harga">Rp 0</div>
                        </div>
                    </div>

                    {{-- Catatan --}}
                    <div>
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea name="catatan"
                                  id="catatan"
                                  rows="3"
                                  class="form-control"
                                  placeholder="Catatan tambahan (opsional)">{{ old('catatan') }}</textarea>
                    </div>

                </div>

                <div class="card-footer bg-white d-flex gap-2">
                    <button type="submit" class="btn btn-warning fw-semibold">
                        <i class="fas fa-paper-plane me-1"></i> Ajukan Rental
                    </button>

                    <a href="{{ route('user.mobil.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- RINGKASAN MOBIL --}}
    <div class="col-lg-4">
        <div class="card shadow-sm">

            @if($mobil->foto)
                <img src="{{ asset('uploads/mobil/' . $mobil->foto) }}"
                     class="card-img-top"
                     style="height:180px; object-fit:cover;"
                     alt="{{ $mobil->merk }} {{ $mobil->model }}">
            @else
                <div class="bg-light text-secondary d-flex align-items-center justify-content-center"
                     style="height:180px;">
                    <i class="fas fa-car fa-3x"></i>
                </div>
            @endif

            <div class="card-body">
                <h5 class="mb-0">{{ $mobil->merk }} {{ $mobil->model }}</h5>
                <small class="text-muted">{{ $mobil->tipe_mobil ?? 'Mobil Rental' }}</small>

                <ul class="list-unstyled small text-muted my-3">
                    <li><i class="fas fa-id-card fa-fw me-1"></i> {{ $mobil->no_plat }}</li>
                    <li><i class="fas fa-calendar-alt fa-fw me-1"></i> Tahun {{ $mobil->tahun }}</li>
                    @if($mobil->transmisi)
                        <li><i class="fas fa-cog fa-fw me-1"></i> {{ $mobil->transmisi }}</li>
                    @endif
                </ul>

                <div class="fw-bold text-success border-top pt-3">
                    Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}
                    <small class="text-muted fw-normal">/ hari</small>
                </div>

                @if($mobil->deskripsi)
                    <div class="border-top mt-3 pt-3">
                        <div class="small fw-semibold text-uppercase text-muted mb-1">Tentang Mobil Ini</div>
                        <p class="small mb-0">{{ $mobil->deskripsi }}</p>
                    </div>
                @endif

                <div class="alert alert-warning small mt-3 mb-0">
                    <i class="fas fa-info-circle me-1"></i>
                    Pengajuan rental akan diproses admin. Kamu akan mendapat notifikasi setelah disetujui.
                </div>
            </div>

        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const tanggalMulai   = document.getElementById('tanggal_mulai');
    const tanggalSelesai = document.getElementById('tanggal_selesai');
    const jumlahHari     = document.getElementById('jumlah_hari');
    const totalHarga     = document.getElementById('total_harga');
    const hargaPerHari   = Number(document.getElementById('harga_per_hari').value);

    function hitungRental() {
        jumlahHari.classList.remove('is-invalid');

        if (!tanggalMulai.value || !tanggalSelesai.value) {
            jumlahHari.value = '0 Hari';
            totalHarga.innerText = 'Rp 0';
            return;
        }

        const mulai   = new Date(tanggalMulai.value);
        const selesai = new Date(tanggalSelesai.value);

        if (selesai < mulai) {
            jumlahHari.value = 'Tanggal tidak valid';
            jumlahHari.classList.add('is-invalid');
            totalHarga.innerText = 'Rp 0';
            return;
        }

        const hari = Math.floor((selesai - mulai) / (1000 * 60 * 60 * 24)) + 1;

        jumlahHari.value = hari + ' Hari';
        totalHarga.innerText = 'Rp ' + (hari * hargaPerHari).toLocaleString('id-ID');
    }

    tanggalMulai.addEventListener('change', function () {
        tanggalSelesai.min = tanggalMulai.value;
        hitungRental();
    });

    tanggalSelesai.addEventListener('change', hitungRental);

    hitungRental();
});
</script>

@endsection