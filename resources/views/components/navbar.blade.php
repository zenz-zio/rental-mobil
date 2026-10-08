<style>
    .main-header.navbar-white.navbar-light {
        background: #fff !important;
        border-bottom: 1px solid #e3e3e6 !important;
        box-shadow: none;
        padding: .55rem 1.1rem;
    }

    /* tombol buka/tutup sidebar */
    .main-header .navbar-nav .nav-link[data-widget="pushmenu"] {
        background: #343a40;
        color: #fff !important;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        padding: 0;
    }

    .main-header .navbar-nav .nav-link[data-widget="pushmenu"]:hover {
        background: #ffc107;
        color: #212529 !important;
    }
</style>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="Buka/tutup menu">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
</nav>