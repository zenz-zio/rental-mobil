@extends('layouts.user')

@section('title', 'Profil Saya')

@section('content')

@php
    $namaUser   = old('nama', $pelanggan->nama ?? auth()->user()->name);
    $nikUser    = old('nik', $pelanggan->nik ?? '');
    $hpUser     = old('no_hp', $pelanggan->no_hp ?? '');
    $alamatUser = old('alamat', $pelanggan->alamat ?? '');

    $terisi = collect([$namaUser, $nikUser, $hpUser, $alamatUser])
        ->filter(fn ($v) => filled($v))
        ->count();
    $persen  = (int) round($terisi / 4 * 100);
    $inisial = mb_strtoupper(mb_substr(trim($namaUser) ?: 'U', 0, 1));
@endphp

<div class="row g-4">

    {{-- RINGKASAN --}}
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-body p-4">

                <div class="rounded-circle bg-dark text-warning d-flex align-items-center justify-content-center fs-2 fw-bold mb-3"
                     style="width:72px; height:72px;"
                     aria-hidden="true">
                    {{ $inisial }}
                </div>

                <h5 class="mb-0 text-break">{{ $namaUser }}</h5>
                <small class="text-muted text-break">{{ auth()->user()->email }}</small>

                <div class="border-top mt-4 pt-3">
                    <div class="d-flex justify-content-between small mb-2">
                        <span>Kelengkapan profil</span>
                        <span class="text-muted">{{ $terisi }} dari 4 data</span>
                    </div>

                    <div class="progress" style="height:6px;"
                         role="progressbar"
                         aria-valuenow="{{ $persen }}"
                         aria-valuemin="0"
                         aria-valuemax="100">
                        <div class="progress-bar bg-warning" style="width: {{ $persen }}%"></div>
                    </div>

                    <small class="text-muted d-block mt-2">
                        @if($persen === 100)
                            Semua data sudah terisi.
                        @else
                            Lengkapi data agar proses layanan berjalan lancar.
                        @endif
                    </small>
                </div>

            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="col-lg-8">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('user.profil.update') }}" method="POST" class="card shadow-sm" novalidate>
            @csrf
            @method('PUT')

            <div class="card-header bg-white">
                <h5 class="mb-0">Profil Saya</h5>
                <small class="text-muted">Perbarui data diri dan kontak Anda.</small>
            </div>

            <div class="card-body">

                {{-- DATA DIRI --}}
                <h6 class="fw-bold mb-3">Data diri</h6>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama lengkap</label>
                    <input type="text"
                           name="nama"
                           id="nama"
                           class="form-control @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $pelanggan->nama ?? auth()->user()->name) }}"
                           autocomplete="name">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <input type="email"
                               id="email"
                               class="form-control"
                               value="{{ auth()->user()->email }}"
                               readonly>
                        <span class="input-group-text" title="Tidak dapat diubah">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                    <div class="form-text">Email mengikuti akun login dan tidak bisa diubah di sini.</div>
                </div>

                <div class="mb-4">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text"
                           name="nik"
                           id="nik"
                           maxlength="16"
                           inputmode="numeric"
                           autocomplete="off"
                           class="form-control @error('nik') is-invalid @enderror"
                           value="{{ old('nik', $pelanggan->nik ?? '') }}"
                           placeholder="16 digit sesuai KTP">
                    @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text d-flex justify-content-between">
                        <span>Hanya angka, sesuai yang tertera di KTP.</span>
                        <span id="nik-hitung">0/16</span>
                    </div>
                </div>

                <hr>

                {{-- KONTAK --}}
                <h6 class="fw-bold mb-3">Kontak</h6>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="text"
                           name="no_hp"
                           id="no_hp"
                           maxlength="13"
                           inputmode="tel"
                           autocomplete="tel"
                           class="form-control @error('no_hp') is-invalid @enderror"
                           value="{{ old('no_hp', $pelanggan->no_hp ?? '') }}"
                           placeholder="Contoh: 081234567890">
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat"
                              id="alamat"
                              rows="4"
                              autocomplete="street-address"
                              class="form-control @error('alamat') is-invalid @enderror"
                              placeholder="Jalan, nomor, kelurahan, kecamatan, kota">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer bg-white text-end">
                <button type="submit" class="btn btn-warning fw-semibold">
                    Simpan perubahan
                </button>
            </div>

        </form>
    </div>

</div>

<script>
(function () {
    var nik = document.getElementById('nik');
    var hp = document.getElementById('no_hp');
    var hitung = document.getElementById('nik-hitung');

    function hanyaAngka(el) {
        el.value = el.value.replace(/\D/g, '');
    }

    function updateHitung() {
        hitung.textContent = nik.value.length + '/16';
    }

    if (nik) {
        nik.addEventListener('input', function () {
            hanyaAngka(nik);
            updateHitung();
        });
        updateHitung();
    }

    if (hp) {
        hp.addEventListener('input', function () {
            hanyaAngka(hp);
        });
    }
})();
</script>

@endsection