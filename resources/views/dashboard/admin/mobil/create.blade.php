@extends('layouts.main')

@section('title', 'Tambah Mobil')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
    :root{
        --aspal:#18181A;
        --aspal-soft:#242427;
        --kapur:#F7F4EE;
        --merah:#D93A2B;
        --merah-deep:#B22A1E;
        --marka:#F2B705;
        --teks-mute:#6b6763;
    }

    .mobil-form-card{
        border:none !important;
        border-radius:6px;
        overflow:hidden;
        box-shadow:6px 6px 0 var(--marka);
    }
    .mobil-form-card .card-header{
        background:var(--aspal) !important;
        border-bottom:none !important;
        padding:1.1rem 1.4rem;
    }
    .mobil-form-card .card-title{
        font-family:'Big Shoulders Display', sans-serif;
        font-weight:800;
        text-transform:uppercase;
        letter-spacing:0.02em;
        font-size:1.3rem;
        color:var(--kapur) !important;
        margin:0;
        display:flex;
        align-items:center;
    }
    .mobil-form-card .card-title i{ color:var(--marka); }
    .mobil-form-card .card-body{ background:#fff; padding:1.6rem 1.4rem; }
    .mobil-form-card .card-footer{
        background:#fff;
        border-top:1px dashed rgba(0,0,0,0.15);
        padding:1.1rem 1.4rem;
        display:flex;
        gap:12px;
    }

    .form-group label{
        font-family:'JetBrains Mono', monospace;
        font-size:11px;
        font-weight:700;
        letter-spacing:0.06em;
        text-transform:uppercase;
        color:var(--aspal);
        margin-bottom:8px;
        display:block;
    }
    .form-control, .custom-select{
        border:1.5px solid rgba(0,0,0,0.15);
        border-radius:3px;
        padding:0.6rem 0.9rem;
        font-family:'Plus Jakarta Sans', sans-serif;
        font-size:0.95rem;
        height:auto;
    }
    .form-control:focus, .custom-select:focus{
        border-color:var(--merah);
        box-shadow:0 0 0 3px rgba(217,58,43,0.12);
    }
    .form-control.is-invalid{ border-color:var(--merah); }
    .invalid-feedback{ color:var(--merah-deep); font-weight:600; font-size:0.8rem; }

    .input-group-text{
        background:var(--aspal);
        color:var(--kapur);
        border:1.5px solid var(--aspal);
        font-weight:700;
        font-family:'JetBrains Mono', monospace;
    }

    .custom-file-label{
        border:1.5px solid rgba(0,0,0,0.15);
        border-radius:3px;
    }

    textarea.form-control{ resize:vertical; }

    .btn-simpan{
        display:inline-flex;
        align-items:center;
        background:var(--merah);
        color:#fff !important;
        border:none;
        border-radius:2px;
        font-weight:700;
        font-size:0.92rem;
        padding:0.65rem 1.3rem;
        box-shadow:4px 4px 0 var(--aspal);
        transition:transform .15s ease, box-shadow .15s ease;
    }
    .btn-simpan:hover{
        color:#fff !important;
        transform:translate(-2px,-2px);
        box-shadow:6px 6px 0 var(--aspal);
    }
    .btn-kembali-form{
        display:inline-flex;
        align-items:center;
        background:transparent;
        color:var(--aspal) !important;
        border:1.5px solid var(--aspal);
        border-radius:2px;
        font-weight:700;
        font-size:0.92rem;
        padding:0.62rem 1.2rem;
        transition:background .15s ease, color .15s ease;
    }
    .btn-kembali-form:hover{
        background:var(--aspal);
        color:var(--kapur) !important;
    }

    .form-section-label{
        font-family:'JetBrains Mono', monospace;
        font-size:11px;
        font-weight:700;
        letter-spacing:0.1em;
        text-transform:uppercase;
        color:var(--merah);
        margin:0.4rem 0 1rem;
        display:flex;
        align-items:center;
        gap:10px;
    }
    .form-section-label::after{
        content:"";
        flex:1;
        height:1px;
        background:repeating-linear-gradient(to right, rgba(0,0,0,0.15) 0 8px, transparent 8px 14px);
    }
</style>

<div class="row">
    <div class="col-md-8">

        <div class="card card-primary mobil-form-card">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-car mr-2"></i>
                    Form Tambah Mobil
                </h3>
            </div>

            <form action="{{ route('admin.mobil.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="card-body">

                    <div class="form-section-label">Data Utama</div>

                    {{-- Merk --}}
                    <div class="form-group">
                        <label for="merk">Merk Mobil</label>

                        <input type="text"
                               name="merk"
                               id="merk"
                               class="form-control @error('merk') is-invalid @enderror"
                               value="{{ old('merk') }}"
                               placeholder="Contoh: Toyota">

                        @error('merk')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- Model --}}
                    <div class="form-group">
                        <label for="model">Model Mobil</label>

                        <input type="text"
                               name="model"
                               id="model"
                               class="form-control @error('model') is-invalid @enderror"
                               value="{{ old('model') }}"
                               placeholder="Contoh: Avanza">

                        @error('model')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- No Plat --}}
                    <div class="form-group">
                        <label for="no_plat">Nomor Plat</label>

                        <input type="text"
                               name="no_plat"
                               id="no_plat"
                               class="form-control @error('no_plat') is-invalid @enderror"
                               value="{{ old('no_plat') }}"
                               placeholder="Contoh: BA 1234 XX">

                        @error('no_plat')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- Tahun --}}
                    <div class="form-group">
                        <label for="tahun">Tahun</label>

                        <input type="number"
                               name="tahun"
                               id="tahun"
                               class="form-control @error('tahun') is-invalid @enderror"
                               value="{{ old('tahun') }}"
                               placeholder="Contoh: 2024">

                        @error('tahun')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- ============================================
                         TAMBAHAN: Transmisi & Tipe Mobil
                    ============================================ --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="transmisi">Transmisi</label>

                                <select name="transmisi"
                                        id="transmisi"
                                        class="form-control @error('transmisi') is-invalid @enderror">

                                    <option value="Matic" {{ old('transmisi') == 'Matic' ? 'selected' : '' }}>Matic</option>
                                    <option value="Manual" {{ old('transmisi') == 'Manual' ? 'selected' : '' }}>Manual</option>

                                </select>

                                @error('transmisi')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipe_mobil">Tipe Mobil</label>

                                <select name="tipe_mobil"
                                        id="tipe_mobil"
                                        class="form-control @error('tipe_mobil') is-invalid @enderror">

                                    <option value="" disabled {{ old('tipe_mobil') ? '' : 'selected' }}>Pilih tipe...</option>
                                    <option value="City Car" {{ old('tipe_mobil') == 'City Car' ? 'selected' : '' }}>City Car</option>
                                    <option value="Sedan" {{ old('tipe_mobil') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                    <option value="SUV" {{ old('tipe_mobil') == 'SUV' ? 'selected' : '' }}>SUV</option>
                                    <option value="MPV" {{ old('tipe_mobil') == 'MPV' ? 'selected' : '' }}>MPV</option>

                                </select>

                                @error('tipe_mobil')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="form-section-label">Harga & Status</div>

                    {{-- Harga --}}
                    <div class="form-group">
                        <label for="harga_per_hari">
                            Harga Rental / Hari
                        </label>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Rp
                                </span>
                            </div>

                            <input type="text"
                                   name="harga_per_hari"
                                   id="harga_per_hari"
                                   class="form-control @error('harga_per_hari') is-invalid @enderror"
                                   value="{{ old('harga_per_hari') }}"
                                   placeholder="350.000"
                                   autocomplete="off"
                                   oninput="formatHarga(this)">

                        </div>

                        @error('harga_per_hari')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                        
                    </div>


                    {{-- Foto --}}
                    <div class="form-group">
                        <label for="foto">Foto Mobil</label>

                        <div class="custom-file">

                            <input type="file"
                                   name="foto"
                                   id="foto"
                                   class="custom-file-input @error('foto') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png,.webp">

                            <label class="custom-file-label"
                                   for="foto">
                                Pilih foto
                            </label>

                        </div>

                        @error('foto')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror

                        <small class="text-muted">
                            Format: JPG, JPEG, PNG, WEBP. Maksimal 2MB.
                        </small>
                    </div>


                    {{-- Status --}}
                    <div class="form-group">
                        <label for="status">Status Mobil</label>

                        <select name="status"
                                id="status"
                                class="form-control @error('status') is-invalid @enderror">

                            <option value="tersedia"
                                {{ old('status', 'tersedia') == 'tersedia' ? 'selected' : '' }}>
                                Tersedia
                            </option>

                            <option value="disewa"
                                {{ old('status') == 'disewa' ? 'selected' : '' }}>
                                Disewa
                            </option>

                        </select>

                        @error('status')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- ============================================
                         TAMBAHAN: Deskripsi
                    ============================================ --}}
                    <div class="form-group mb-0">
                        <label for="deskripsi">Deskripsi / Keterangan Mobil</label>

                        <textarea name="deskripsi"
                                  id="deskripsi"
                                  rows="4"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Contoh: Mobil terawat, servis rutin, cocok untuk perjalanan luar kota. (opsional)">{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                </div>


                <div class="card-footer">

                    <button type="submit"
                            class="btn-simpan">
                        <i class="fas fa-save mr-1"></i>
                        Simpan
                    </button>

                    <a href="{{ route('admin.mobil.index') }}"
                       class="btn-kembali-form">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>
</div>


{{-- Format otomatis harga --}}
<script>
    function formatHarga(input) {

        // Ambil angka saja
        let angka = input.value.replace(/\D/g, '');

        // Kalau kosong
        if (angka === '') {
            input.value = '';
            return;
        }

        // Tambahkan titik setiap 3 angka
        input.value = new Intl.NumberFormat('id-ID').format(Number(angka));
    }


    // Saat form disubmit
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.querySelector('form');
        const hargaInput = document.getElementById('harga_per_hari');

        form.addEventListener('submit', function () {

            // Hapus titik sebelum dikirim ke Laravel
            hargaInput.value = hargaInput.value.replace(/\./g, '');

        });

    });
</script>

@endsection