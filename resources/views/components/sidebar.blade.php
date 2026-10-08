@php
    $isAdmin = auth()->check() && auth()->user()->role === 'admin';
@endphp

<style>
    .main-sidebar.sidebar-dark-primary {
        --sb-bg: #343a40;
        --sb-bg-soft: #2b3035;
        --sb-text: #c2c7d0;
        --sb-mute: #8b9097;
        --sb-accent: #ffc107;
        background: var(--sb-bg) !important;
        border-right: 1px solid rgba(255, 255, 255, .06);
    }

    .main-sidebar .sidebar {
        display: flex;
        flex-direction: column;
        height: calc(100% - 57px);
    }

    /* ===== BRAND ===== */
    .main-sidebar .brand-link {
        background: var(--sb-bg);
        border-bottom: 1px solid rgba(255, 255, 255, .08);
        padding: .85rem 1.1rem;
        display: flex;
        align-items: center;
    }

    .main-sidebar .brand-link .brand-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: var(--sb-accent);
        color: #212529;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: .75rem;
        flex-shrink: 0;
    }

    .main-sidebar .brand-link .brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.15;
        color: #fff;
        font-weight: 700;
        font-size: 1.05rem;
    }

    .main-sidebar .brand-link .brand-text small {
        color: var(--sb-mute);
        font-weight: 400;
        font-size: .72rem;
    }

    /* ===== USER PANEL ===== */
    .main-sidebar .user-panel {
        background: var(--sb-bg-soft);
        border-bottom: 1px solid rgba(255, 255, 255, .08) !important;
        padding: 1rem 1.1rem !important;
        align-items: center;
    }

    .main-sidebar .user-panel .image img {
        width: 2.4rem;
        height: 2.4rem;
        object-fit: cover;
        border: 2px solid rgba(255, 255, 255, .12);
    }

    .main-sidebar .user-panel .info a {
        color: #fff !important;
        font-weight: 600;
        font-size: .92rem;
        line-height: 1.2;
    }

    .main-sidebar .user-panel .role-badge {
        display: inline-block;
        margin-top: .25rem;
        background: var(--sb-accent);
        color: #212529;
        font-size: .68rem;
        font-weight: 700;
        padding: .1rem .5rem;
        border-radius: 999px;
    }

    /* ===== LABEL ===== */
    .main-sidebar .nav-label {
        color: var(--sb-mute);
        font-size: .75rem;
        font-weight: 600;
        padding: 1rem 1.25rem .4rem;
    }

    /* ===== NAV ===== */
    .main-sidebar .nav-sidebar {
        padding: 0 .75rem;
    }

    .main-sidebar .nav-sidebar > .nav-item {
        margin-bottom: .2rem;
    }

    .main-sidebar .nav-sidebar .nav-link {
        color: var(--sb-text) !important;
        border-radius: 8px;
        font-size: .92rem;
        padding: .55rem .7rem;
        display: flex;
        align-items: center;
        transition: background .15s, color .15s;
    }

    .main-sidebar .nav-sidebar .nav-link .nav-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: rgba(255, 255, 255, .06);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .85rem;
        margin: 0 .7rem 0 0 !important;
        flex-shrink: 0;
        transition: background .15s, color .15s;
    }

    .main-sidebar .nav-sidebar .nav-link p {
        margin: 0;
    }

    .main-sidebar .nav-sidebar .nav-link:hover {
        background: rgba(255, 255, 255, .07) !important;
        color: #fff !important;
    }

    .main-sidebar .nav-sidebar .nav-link:hover .nav-icon {
        color: var(--sb-accent);
    }

    .main-sidebar .nav-sidebar .nav-link.active {
        background: var(--sb-accent) !important;
        color: #212529 !important;
        font-weight: 700;
        box-shadow: none !important;
    }

    .main-sidebar .nav-sidebar .nav-link.active .nav-icon {
        background: rgba(0, 0, 0, .12);
        color: #212529;
    }

    /* ===== LOGOUT ===== */
    .main-sidebar .nav-sidebar li.nav-logout {
        border-top: 1px solid rgba(255, 255, 255, .08);
        margin-top: .75rem;
        padding-top: .75rem;
    }

    .main-sidebar .nav-sidebar button.nav-link:hover {
        background: rgba(220, 53, 69, .15) !important;
        color: #ff8a94 !important;
    }

    .main-sidebar .nav-sidebar button.nav-link:hover .nav-icon {
        color: #ff8a94;
    }

    /* ===== FOOTER ===== */
    .main-sidebar .sidebar-foot {
        margin-top: auto;
        padding: .9rem 1.25rem 1.1rem;
        border-top: 1px solid rgba(255, 255, 255, .08);
        color: var(--sb-mute);
        font-size: .75rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .main-sidebar .sidebar-foot .v-tag {
        background: rgba(255, 255, 255, .07);
        padding: .1rem .5rem;
        border-radius: 999px;
    }

    /* ===== DIALOG KONFIRMASI LOGOUT ===== */
    .lg-modal {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, .5);
        padding: 1rem;
    }

    .lg-modal[hidden] { display: none; }

    .lg-box {
        background: #fff;
        border-radius: 12px;
        padding: 1.75rem 1.5rem 1.5rem;
        width: 100%;
        max-width: 360px;
        text-align: center;
        box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .2);
    }

    .lg-icon {
        width: 52px;
        height: 52px;
        margin: 0 auto 1rem;
        border-radius: 12px;
        background: #343a40;
        color: #ffc107;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lg-title {
        font-weight: 700;
        margin: 0 0 .35rem;
        color: #212529;
    }

    .lg-text {
        color: #6b6b70;
        font-size: .92rem;
        margin: 0 0 1.25rem;
    }

    .lg-actions {
        display: flex;
        gap: .6rem;
    }

    .lg-btn {
        flex: 1;
        height: 2.7rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: .92rem;
        cursor: pointer;
    }

    .lg-btn-cancel {
        background: #fff;
        border: 1px solid #e3e3e6;
        color: #6b6b70;
    }

    .lg-btn-cancel:hover { background: #f6f6f7; color: #212529; }

    .lg-btn-confirm {
        background: #ffc107;
        border: none;
        color: #212529;
    }

    .lg-btn-confirm:hover { background: #e0a800; }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    {{-- Logo --}}
    <a href="{{ $isAdmin ? route('admin.dashboard') : route('user.dashboard') }}"
       class="brand-link">

        <span class="brand-icon"><i class="fas fa-car"></i></span>

        <span class="brand-text">
            Tempuh ID
            <small>Rental Management</small>
        </span>

    </a>

    <div class="sidebar">

        {{-- User --}}
        <div class="user-panel mt-0 pb-0 mb-0 d-flex">

            <div class="image">
                <img src="{{ asset('assets/AdminLTE/dist/img/user2-160x160.jpg') }}"
                     class="img-circle elevation-2"
                     alt="User">
            </div>

            <div class="info">
                <a href="{{ $isAdmin ? '#' : route('user.profil') }}" class="d-block">
                    {{ auth()->user()->name ?? 'User' }}
                </a>

                <span class="role-badge">
                    {{ $isAdmin ? 'Administrator' : 'Pelanggan' }}
                </span>
            </div>

        </div>

        <div class="nav-label">Menu utama</div>

        {{-- Menu --}}
        <nav>

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                @if($isAdmin)

                    {{-- ADMIN --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.mobil.index') }}"
                           class="nav-link {{ request()->routeIs('admin.mobil.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-car"></i>
                            <p>Data Mobil</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.pelanggan.index') }}"
                           class="nav-link {{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Pelanggan</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.rental.index') }}"
                           class="nav-link {{ request()->routeIs('admin.rental.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>Data Rental</p>
                        </a>
                    </li>

                @else

                    {{-- USER --}}
                    <li class="nav-item">
                        <a href="{{ route('user.dashboard') }}"
                           class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('user.mobil.index') }}"
                           class="nav-link {{ request()->routeIs('user.mobil.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-car"></i>
                            <p>Daftar Mobil</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('user.rental.index') }}"
                           class="nav-link {{ request()->routeIs('user.rental.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>Rental Saya</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('user.profil') }}"
                           class="nav-link {{ request()->routeIs('user.profil') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Profil Saya</p>
                        </a>
                    </li>

                @endif

                {{-- LOGOUT --}}
                <li class="nav-item nav-logout">
                    <button type="button"
                            id="btnLogout"
                            class="nav-link border-0 bg-transparent w-100 text-left">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </button>
                </li>

            </ul>

        </nav>

        <div class="sidebar-foot">
            <span>Tempuh Panel</span>
            <span class="v-tag">v1.0</span>
        </div>

    </div>

</aside>

{{-- FORM LOGOUT (dikirim setelah konfirmasi) --}}
<form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

{{-- DIALOG KONFIRMASI LOGOUT --}}
<div id="logoutModal" class="lg-modal" hidden>
    <div class="lg-box" role="dialog" aria-modal="true" aria-labelledby="lgTitle">
        <div class="lg-icon"><i class="fas fa-sign-out-alt"></i></div>
        <h5 id="lgTitle" class="lg-title">Keluar dari akun?</h5>
        <p class="lg-text">Kamu perlu masuk lagi untuk mengakses akunmu.</p>
        <div class="lg-actions">
            <button type="button" id="lgCancel" class="lg-btn lg-btn-cancel">Batal</button>
            <button type="button" id="lgConfirm" class="lg-btn lg-btn-confirm">Ya, keluar</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal   = document.getElementById('logoutModal');
    const openBtn = document.getElementById('btnLogout');
    const cancel  = document.getElementById('lgCancel');
    const confirm = document.getElementById('lgConfirm');
    const form    = document.getElementById('logoutForm');

    // pindahkan dialog ke <body> supaya selalu menutupi seluruh layar
    document.body.appendChild(modal);

    function buka()  { modal.hidden = false; cancel.focus(); }
    function tutup() { modal.hidden = true; openBtn.focus(); }

    openBtn.addEventListener('click', buka);
    cancel.addEventListener('click', tutup);
    confirm.addEventListener('click', function () { form.submit(); });

    // klik area gelap di luar kotak = batal
    modal.addEventListener('click', function (e) {
        if (e.target === modal) tutup();
    });

    // tombol Esc = batal
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !modal.hidden) tutup();
    });
});
</script>