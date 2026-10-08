<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | TEMPUH.ID</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
        <div class="container">

            <a class="navbar-brand fw-bold" href="{{ route('user.dashboard') }}">
                TEMPUH<span class="text-warning">.ID</span>
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#userNav"
                    aria-controls="userNav" aria-expanded="false" aria-label="Buka menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="userNav">

                <ul class="navbar-nav mx-auto align-items-md-center gap-md-1 mb-2 mb-md-0">
                    @php
                        $menus = [
                            ['route' => 'user.dashboard',    'active' => 'user.dashboard', 'icon' => 'fa-home',         'label' => 'Dashboard'],
                            ['route' => 'user.mobil.index',  'active' => 'user.mobil.*',   'icon' => 'fa-car',          'label' => 'Mobil'],
                            ['route' => 'user.rental.index', 'active' => 'user.rental.*',  'icon' => 'fa-file-invoice', 'label' => 'Rental Saya'],
                            ['route' => 'user.profil',       'active' => 'user.profil',    'icon' => 'fa-user',         'label' => 'Profil'],
                        ];
                    @endphp

                    @foreach($menus as $m)
                        <li class="nav-item">
                            <a class="nav-link px-3 rounded {{ request()->routeIs($m['active']) ? 'active bg-secondary bg-opacity-25 text-white' : '' }}"
                               href="{{ route($m['route']) }}">
                                <i class="fas {{ $m['icon'] }} me-2"></i>{{ $m['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                {{-- Tombol logout: membuka dialog konfirmasi --}}
                <div class="m-0 pb-2 pb-md-0">
                    <button type="button"
                            class="btn btn-sm btn-danger text-nowrap"
                            data-bs-toggle="modal"
                            data-bs-target="#logoutModal">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </div>

            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    <main class="flex-grow-1 py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="bg-dark text-secondary small py-3">
        <div class="container d-flex flex-column flex-md-row justify-content-between gap-1">
            <div><strong class="text-white">TEMPUH.ID</strong> &mdash; Rental Mobil</div>
            <div>&copy; 2026-2027 All rights reserved.</div>
        </div>
    </footer>

    {{-- DIALOG KONFIRMASI LOGOUT --}}
    <div class="modal" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 360px;">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <div class="modal-body text-center p-4">
                        <div class="bg-dark text-warning rounded-3 d-inline-flex align-items-center justify-content-center mb-3"
                             style="width:52px; height:52px; font-size:1.25rem;">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>

                        <h5 class="fw-bold mb-1" id="logoutModalLabel">Keluar dari akun?</h5>
                        <p class="text-muted small mb-4">Kamu perlu masuk lagi untuk mengakses akunmu.</p>

                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-warning fw-semibold w-100">
                                Ya, keluar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>