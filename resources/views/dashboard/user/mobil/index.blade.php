@extends('layouts.user')

@section('title', 'Daftar Mobil')

@section('content')

<div class="mb-3">
    <h4 class="fw-bold mb-0">Daftar Mobil Rental</h4>
    <p class="text-muted mb-0">Pilih mobil yang ingin kamu rental.</p>
</div>

<form method="GET" action="{{ route('user.mobil.index') }}">

    {{-- SEARCH + SORT --}}
    <div class="row g-2 mb-3">
        <div class="col-md">
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control"
                       placeholder="Cari merk atau model mobil...">
            </div>
        </div>

        <div class="col-md-3">
            <select name="sort" class="form-select" onchange="this.form.submit()">
                <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Urutkan: Rekomendasi</option>
                <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                <option value="year-desc" {{ request('sort') == 'year-desc' ? 'selected' : '' }}>Tahun Terbaru</option>
            </select>
        </div>

        <div class="col-md-auto">
            <button type="submit" class="btn btn-warning fw-semibold w-100">
                <i class="fas fa-search me-1"></i> Cari
            </button>
        </div>
    </div>

    {{-- CHIP FILTER AKTIF --}}
    <div class="d-flex flex-wrap gap-2 mb-3">

        @if(request('search'))
            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
               class="badge rounded-pill text-bg-dark text-decoration-none">
                "{{ request('search') }}" <i class="fas fa-times ms-1"></i>
            </a>
        @endif

        @if(request('transmisi'))
            <a href="{{ request()->fullUrlWithQuery(['transmisi' => null]) }}"
               class="badge rounded-pill text-bg-dark text-decoration-none">
                {{ request('transmisi') }} <i class="fas fa-times ms-1"></i>
            </a>
        @endif

        @if(request('tipe'))
            @foreach((array) request('tipe') as $t)
                <a href="{{ request()->fullUrlWithQuery(['tipe' => collect(request('tipe'))->reject(fn($x) => $x === $t)->values()->all()]) }}"
                   class="badge rounded-pill text-bg-dark text-decoration-none">
                    {{ $t }} <i class="fas fa-times ms-1"></i>
                </a>
            @endforeach
        @endif

        @if(!request()->boolean('tersedia', true))
            <a href="{{ request()->fullUrlWithQuery(['tersedia' => 1]) }}"
               class="badge rounded-pill text-bg-dark text-decoration-none">
                Termasuk yang Disewa <i class="fas fa-times ms-1"></i>
            </a>
        @endif

    </div>

    {{-- FILTER --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <strong>Filter</strong>
            <a href="{{ route('user.mobil.index') }}" class="small text-danger text-decoration-none">Reset</a>
        </div>

        <div class="card-body">
            <div class="row g-4">

                {{-- Tersedia --}}
                <div class="col-md-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input"
                               type="checkbox"
                               role="switch"
                               id="filterTersedia"
                               name="tersedia"
                               value="1"
                               {{ request()->boolean('tersedia', true) ? 'checked' : '' }}
                               onchange="this.form.submit()">
                        <label class="form-check-label" for="filterTersedia">Hanya yang Tersedia</label>
                    </div>
                </div>

                {{-- Transmisi --}}
                <div class="col-md-4">
                    <div class="fw-semibold mb-2">Transmisi</div>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="transmisi" id="trMatic" value="Matic"
                               {{ request('transmisi') == 'Matic' ? 'checked' : '' }}
                               onchange="this.form.submit()">
                        <label class="btn btn-outline-secondary btn-sm" for="trMatic">Matic</label>

                        <input type="radio" class="btn-check" name="transmisi" id="trManual" value="Manual"
                               {{ request('transmisi') == 'Manual' ? 'checked' : '' }}
                               onchange="this.form.submit()">
                        <label class="btn btn-outline-secondary btn-sm" for="trManual">Manual</label>
                    </div>
                </div>

                {{-- Tipe --}}
                <div class="col-md-4">
                    <div class="fw-semibold mb-2">Tipe Mobil</div>
                    @foreach(['City Car', 'Sedan', 'SUV', 'MPV'] as $i => $tipe)
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="tipe{{ $i }}"
                                   name="tipe[]"
                                   value="{{ $tipe }}"
                                   {{ in_array($tipe, (array) request('tipe', [])) ? 'checked' : '' }}
                                   onchange="this.form.submit()">
                            <label class="form-check-label" for="tipe{{ $i }}">{{ $tipe }}</label>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

</form>

{{-- GRID MOBIL --}}
<div class="row g-3">

    @forelse($mobils as $mobil)

        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">

                {{-- Foto --}}
                @if($mobil->foto)
                    <img src="{{ asset('uploads/mobil/' . $mobil->foto) }}"
                         class="card-img-top"
                         style="height:170px; object-fit:cover;"
                         alt="{{ $mobil->merk }} {{ $mobil->model }}">
                @else
                    <div class="bg-light text-secondary d-flex align-items-center justify-content-center"
                         style="height:170px;">
                        <i class="fas fa-car fa-3x"></i>
                    </div>
                @endif

                <div class="card-body d-flex flex-column">

                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title mb-0">{{ $mobil->merk }} {{ $mobil->model }}</h5>
                            <small class="text-muted">{{ $mobil->tipe_mobil ?? 'Mobil Rental' }}</small>
                        </div>

                        @if($mobil->status === 'tersedia')
                            <span class="badge text-bg-success">Tersedia</span>
                        @else
                            <span class="badge text-bg-secondary">Disewa</span>
                        @endif
                    </div>

                    <ul class="list-unstyled small text-muted my-3">
                        <li><i class="fas fa-id-card fa-fw me-1"></i> {{ $mobil->no_plat }}</li>
                        <li><i class="fas fa-calendar-alt fa-fw me-1"></i> Tahun {{ $mobil->tahun }}</li>
                        @if($mobil->transmisi)
                            <li><i class="fas fa-cog fa-fw me-1"></i> {{ $mobil->transmisi }}</li>
                        @endif
                    </ul>

                    <div class="d-flex justify-content-between align-items-end mt-auto pt-3 border-top">
                        <div>
                            <div class="fw-bold text-success">
                                Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}
                            </div>
                            <small class="text-muted">per hari</small>
                        </div>

                        @if($mobil->status === 'tersedia')
                            <a href="{{ route('user.mobil.rental', $mobil->id) }}"
                               class="btn btn-sm btn-warning fw-semibold">
                                Pilih
                            </a>
                        @else
                            <button class="btn btn-sm btn-secondary" disabled>Disewa</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    @empty

        <div class="col-12">
            <div class="alert alert-light border mb-0">
                <i class="fas fa-info-circle me-2"></i>
                Tidak ada mobil yang cocok dengan pencarian/filter kamu.
            </div>
        </div>

    @endforelse

</div>

@endsection