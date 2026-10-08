@extends('layouts.main')

@section('title', 'Edit Mobil')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
    :root{
        --aspal:#18181A;
        --aspal-soft:#242427;
        --kapur:#F7F4EE;
        --marka:#F2B705;
        --marka-deep:#c99900;
        --teks-mute:#6b6763;
    }

    .mobil-form-card{
        border:none !important;
        border-radius:6px;
        overflow:hidden;
        box-shadow:6px 6px 0 var(--aspal);
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
        border-color:var(--marka-deep);
        box-shadow:0 0 0 3px rgba(242,183,5,0.18);
    }
    .form-control.is-invalid{ border-color:#D93A2B; }
    .invalid-feedback, .text-danger{ color:#B22A1E !important; font-weight:600; font-size:0.8rem; }

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

    .foto-preview{
        border-radius:6px;
        border:1.5px solid rgba(0,0,0,0.1);
        padding:6px;
        background:#fbfaf7;
        display:inline-block;
    }
    .foto-preview img{ border-radius:3px; display:block; }

    .btn-update{
        display:inline-flex;
        align-items:center;
        background:var(--marka);
        color:var(--aspal) !important;
        border:none;
        border-radius:2px;
        font-weight:700;
        font-size:0.92rem;
        padding:0.65rem 1.3rem;
        box-shadow:4px 4px 0 var(--aspal);
        transition:transform .15s ease, box-shadow .15s ease;
    }
    .btn-update:hover{
        color:var(--aspal) !important;
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
        color:var(--marka-deep);
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

        <div class="card card-warning mobil-form-card">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Data Mobil
                </h3>
            </div>

            <form action="{{ route('admin.mobil.update', $mobil->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-section-label">Data Utama</div>

                    {{-- Merk --}}
                    <div class="form-group">
                        <label>Merk Mobil</label>

                        <input type="text"
                               name="merk"
                               class="form-control"
                               value="{{ old('merk', $mobil->merk) }}">

                        @error('merk')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- Model --}}
                    <div class="form-group">
                        <label>Model Mobil</label>

                        <input type="text"
                               name="model"
                               class="form-control"
                               value="{{ old('model', $mobil->model) }}">

                        @error('model')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- Nomor Plat --}}
                    <div class="form-group">
                        <label>Nomor Plat</label>

                        <input type="text"
                               name="no_plat"
                               class="form-control"
                               value="{{ old('no_plat', $mobil->no_plat) }}">

                        @error('no_plat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- Tahun --}}
                    <div class="form-group">
                        <label>Tahun</label>

                        <input type="number"
                               name="tahun"
                               class="form-control"
                               value="{{ old('tahun', $mobil->tahun) }}">

                        @error('tahun')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    {{-- ============================================
                         TAMBAHAN: Transmisi & Tipe Mobil
                    ============================================ --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Transmisi</label>

                                <select name="transmisi" class="form-control @error('transmisi') is-invalid @enderror">

                                    <option value="Matic" {{ old('transmisi', $mobil->transmisi) == 'Matic' ? 'selected' : '' }}>Matic</option>
                                    <option value="Manual" {{ old('transmisi', $mobil->transmisi) == 'Manual' ? 'selected' : '' }}>Manual</option>

                                </select>

                                @error('transmisi')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipe Mobil</label>

                                <select name="tipe_mobil" class="form-control @error('tipe_mobil') is-invalid @enderror">

                                    <option value="" disabled {{ old('tipe_mobil', $mobil->tipe_mobil) ? '' : 'selected' }}>Pilih tipe...</option>
                                    <option value="City Car" {{ old('tipe_mobil', $mobil->tipe_mobil) == 'City Car' ? 'selected' : '' }}>City Car</option>
                                    <option value="Sedan" {{ old('tipe_mobil', $mobil->tipe_mobil) == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                    <option value="SUV" {{ old('tipe_mobil', $mobil->tipe_mobil) == 'SUV' ? 'selected' : '' }}>SUV</option>
                                    <option value="MPV" {{ old('tipe_mobil', $mobil->tipe_mobil) == 'MPV' ? 'selected' : '' }}>MPV</option>

                                </select>

                                @error('tipe_mobil')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="form-section-label">Harga & Status</div>

                    {{-- Harga --}}
                    <div class="form-group">
                        <label>Harga Rental / Hari</label>

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
                                   value="{{ old('harga_per_hari', number_format($mobil->harga_per_hari, 0, ',', '.')) }}"
                                   placeholder="350.000"
                                   autocomplete="off">

                        </div>

                        @error('harga_per_hari')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Foto --}}
                    <div class="form-group">
                        <label>Foto Mobil</label>

                        @if($mobil->foto)
                            <div class="mb-2 foto-preview">
                                <img src="{{ asset('uploads/mobil/' . $mobil->foto) }}"
                                     width="150">
                            </div>
                        @endif

                        <div class="custom-file">

                            <input type="file"
                                   name="foto"
                                   id="foto"
                                   class="custom-file-input"
                                   accept=".jpg,.jpeg,.png,.webp">

                            <label class="custom-file-label" for="foto">
                                Pilih foto baru
                            </label>

                        </div>

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti foto.
                        </small>

                        @error('foto')
                            <br>
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>


                    {{-- Status --}}
                    <div class="form-group">
                        <label>Status Mobil</label>

                        <select name="status" class="form-control">

                            <option value="tersedia"
                                {{ old('status', $mobil->status) == 'tersedia' ? 'selected' : '' }}>
                                Tersedia
                            </option>

                            <option value="disewa"
                                {{ old('status', $mobil->status) == 'disewa' ? 'selected' : '' }}>
                                Disewa
                            </option>

                        </select>
                    </div>


                    {{-- ============================================
                         TAMBAHAN: Deskripsi
                    ============================================ --}}
                    <div class="form-group mb-0">
                        <label>Deskripsi / Keterangan Mobil</label>

                        <textarea name="deskripsi"
                                  rows="4"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Contoh: Mobil terawat, servis rutin, cocok untuk perjalanan luar kota. (opsional)">{{ old('deskripsi', $mobil->deskripsi) }}</textarea>

                        @error('deskripsi')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>


                {{-- Tombol --}}
                <div class="card-footer">

                    <button type="submit" class="btn-update">
                        <i class="fas fa-save mr-1"></i>
                        Update
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
document.addEventListener('DOMContentLoaded', function () {

    const hargaInput = document.getElementById('harga_per_hari');
    const form = hargaInput.closest('form');

    // Saat halaman dibuka, format harga yang sudah ada
    if (hargaInput.value !== '') {
        let angka = hargaInput.value.replace(/\D/g, '');

        if (angka !== '') {
            hargaInput.value = new Intl.NumberFormat('id-ID').format(Number(angka));
        }
    }

    // Saat mengetik, otomatis kasih titik
    hargaInput.addEventListener('input', function () {

        let angka = this.value.replace(/\D/g, '');

        if (angka === '') {
            this.value = '';
            return;
        }

        this.value = new Intl.NumberFormat('id-ID').format(Number(angka));

    });

    // Sebelum dikirim, hapus titik
    form.addEventListener('submit', function () {

        hargaInput.value = hargaInput.value.replace(/\./g, '');

    });

});
</script>

@endsection