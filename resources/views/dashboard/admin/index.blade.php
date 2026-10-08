@extends('layouts.main')

@section('title', 'Dashboard Rental Mobil')

@section('content')

<style>
    .dash .stat-card {
        background: #fff;
        border: 1px solid #e3e3e6;
        border-radius: 12px;
        box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
        overflow: hidden;
        margin-bottom: 1.25rem;
        height: calc(100% - 1.25rem);
    }

    .dash .stat-body {
        display: flex;
        align-items: center;
        padding: 1.25rem;
    }

    .dash .stat-icon {
        flex: 0 0 56px;
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-right: 1rem;
    }

    .dash .stat-icon.info    { background: rgba(23, 162, 184, .12); color: #17a2b8; }
    .dash .stat-icon.success { background: rgba(40, 167, 69, .12);  color: #28a745; }
    .dash .stat-icon.warning { background: rgba(255, 193, 7, .2);   color: #c99700; }
    .dash .stat-icon.danger  { background: rgba(220, 53, 69, .12);  color: #dc3545; }

    .dash .stat-number {
        font-size: 1.9rem;
        font-weight: 700;
        line-height: 1.1;
        margin: 0;
    }

    .dash .stat-label {
        margin: 0;
        color: #6b6b70;
        font-size: .9rem;
    }

    .dash .stat-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: .65rem 1.25rem;
        background: #f8f9fa;
        border-top: 1px solid #e3e3e6;
        font-size: .85rem;
        font-weight: 600;
        color: #343a40;
    }

    .dash .stat-footer:hover {
        background: #343a40;
        color: #ffc107;
        text-decoration: none;
    }

    .dash .welcome {
        background: #343a40;
        color: #fff;
        border-radius: 12px;
        border: none;
        overflow: hidden;
        box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
    }

    .dash .welcome .welcome-tag {
        color: #ffc107;
        font-size: .85rem;
        font-weight: 600;
    }

    .dash .welcome .welcome-icon {
        font-size: 5rem;
        color: rgba(255, 193, 7, .25);
    }
</style>

<div class="dash">

    <div class="row">

        {{-- Total Mobil --}}
        <div class="col-lg-3 col-6">
            <div class="stat-card">
                <div class="stat-body">
                    <div class="stat-icon info"><i class="fas fa-car"></i></div>
                    <div>
                        <p class="stat-number">{{ $totalMobil }}</p>
                        <p class="stat-label">Total Mobil</p>
                    </div>
                </div>
                <a href="{{ route('admin.mobil.index') }}" class="stat-footer">
                    <span>Lihat Mobil</span>
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Mobil Tersedia --}}
        <div class="col-lg-3 col-6">
            <div class="stat-card">
                <div class="stat-body">
                    <div class="stat-icon success"><i class="fas fa-car-side"></i></div>
                    <div>
                        <p class="stat-number">{{ $mobilTersedia }}</p>
                        <p class="stat-label">Mobil Tersedia</p>
                    </div>
                </div>
                <a href="{{ route('admin.mobil.index') }}" class="stat-footer">
                    <span>Lihat Mobil</span>
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Mobil Disewa --}}
        <div class="col-lg-3 col-6">
            <div class="stat-card">
                <div class="stat-body">
                    <div class="stat-icon warning"><i class="fas fa-key"></i></div>
                    <div>
                        <p class="stat-number">{{ $mobilDisewa }}</p>
                        <p class="stat-label">Mobil Disewa</p>
                    </div>
                </div>
                <a href="{{ route('admin.mobil.index') }}" class="stat-footer">
                    <span>Lihat Mobil</span>
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Total Rental --}}
        <div class="col-lg-3 col-6">
            <div class="stat-card">
                <div class="stat-body">
                    <div class="stat-icon danger"><i class="fas fa-file-invoice"></i></div>
                    <div>
                        <p class="stat-number">{{ $totalRental }}</p>
                        <p class="stat-label">Total Rental</p>
                    </div>
                </div>
                <a href="#" class="stat-footer">
                    <span>Lihat Rental</span>
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div>

    {{-- Selamat Datang --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card welcome">
                <div class="card-body p-4 p-lg-5 d-flex align-items-center justify-content-between">

                    <div>
                        <div class="welcome-tag mb-2">
                            <i class="fas fa-car mr-1"></i> Tempuh ID — Rental Mobil
                        </div>

                        <h4 class="font-weight-bold">Selamat datang di dashboard rental mobil</h4>

                        <p class="text-white-50 mb-4">
                            Kelola data mobil, pelanggan, dan transaksi rental
                            melalui dashboard ini.
                        </p>

                        <a href="{{ route('admin.mobil.index') }}"
                           class="btn btn-warning font-weight-bold">
                            <i class="fas fa-car mr-1"></i>
                            Kelola Data Mobil
                        </a>
                    </div>

                    <div class="welcome-icon d-none d-md-block ml-4">
                        <i class="fas fa-car-side"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection