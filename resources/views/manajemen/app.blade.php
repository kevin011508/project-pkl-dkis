<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ISUN')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3943ae;
            --secondary-color: #4e73df;
            --success-color: #2ecc71;
            --light-bg: #f8f9fa;
            --border-radius: 10px;
            --box-shadow: 0 4px 6px rgba(42, 42, 44, 0.116);
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .wrapper {
            display: flex;
            flex: 1;
            margin-top: 56px;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            min-height: calc(100vh - 56px - 50px);
            width: calc(100% - 250px);
            transition: margin-left 0.3s;
        }

        .site-footer {
            width: 100%;
            padding-left: 250px;
            padding-right: 0;
            padding-top: 15px;
            padding-bottom: 15px;
            background-color: #2741a7;
            text-align: center;
            flex-shrink: 0;
        }

        .site-footer p {
            color: white;
            margin: 0;
            font-size: 14px;
        }

        .navbar {
            background-color: #2741a7;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1100;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            letter-spacing: 2px;
        }

        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            width: 250px;
            height: calc(100vh - 56px);
            background-color: var(--primary-color);
            color: white;
            z-index: 1000;
            overflow-y: auto;
            overflow-x: hidden;
            padding-top: 15px;
            transition: all 0.3s;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--secondary-color);
        }

        .sidebar i {
            width: 25px;
            margin-right: 10px;
        }

        .sidebar .active {
            background-color: rgba(255, 255, 255, 0.15);
            border-left: 4px solid var(--secondary-color);
            font-weight: 500;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(235, 6, 6, 0.1);
            margin-bottom: 10px;
        }

        .sidebar-title {
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0;
        }

        .table-container {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--box-shadow);
            margin-top: 20px;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .table-controls {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .entries-filter {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .entries-filter label {
            margin-bottom: 0;
            font-size: 0.9rem;
            color: #555;
        }

        .btn-rekap {
            background-color: var(--success-color);
            color: rgba(0, 0, 0, 0.842);
            border: none;
            padding: 8px 20px;
            border-radius: var(--border-radius);
            font-weight: 500;
        }

        .btn-tambah {
            background-color: var(--secondary-color);
            color: rgba(0, 0, 0, 0.842);
            border: none;
            padding: 8px 20px;
            border-radius: var(--border-radius);
            font-weight: 500;
        }

        .btn-rekap:hover, .btn-tambah:hover {
            opacity: 0.9;
            color: rgb(0, 0, 0);
        }

        .table {
            margin-bottom: 0;
            width: 100%;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
            vertical-align: middle;
            white-space: nowrap;
        }

        .table td {
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn-action {
            padding: 4px 8px;
            font-size: 0.85rem;
            margin: 2px;
        }

        .btn-detail {
            background-color: #17a2b8;
            color: white;
            border: none;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #212529;
            border: none;
        }

        .btn-hapus {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .pagination-info {
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 15px;
        }

        .search-box {
            max-width: 300px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .badge-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-selesai {
            background-color: #28a745;
            color: white;
        }

        .badge-berjalan {
            background-color: #17a2b8;
            color: white;
        }

        .badge-belum {
            background-color: #ffc107;
            color: #212529;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 10px;
        }

        .sidebar hr {
            opacity: 0.2;
        }

        .sidebar .collapse a {
            font-size: 0.95rem;
            padding-left: 40px;
        }

        .dropdown-menu-custom {
            display: none;
            list-style: none;
            padding-left: 0;
        }

        .sidebar-dropdown.open .dropdown-menu-custom {
            display: block;
        }

        .sidebar-dropdown .arrow {
            float: right;
            transition: transform 0.3s;
        }

        .sidebar-dropdown.open .arrow {
            transform: rotate(180deg);
        }

        .menu-title {
            display: block;
            text-align: center;
            font-weight: 700;
            font-size: 0.8rem;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 15px 20px 8px;
            list-style: none;
        }

        .btn-display {
            display: flex !important;
            align-items: center;
            gap: 10px;
            color: white !important;
            background-color: transparent;
            border: 2px solid white !important;
            border-left: 2px solid white !important;
            border-radius: 8px;
            padding: 10px 15px !important;
            font-weight: 500;
            margin-top: 10px;
            transition: all 0.3s;
        }

        .btn-display:hover {
            background-color: rgba(255, 255, 255, 0.15) !important;
            border-left: 2px solid white !important;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
                overflow: hidden;
            }

            .sidebar:hover {
                width: 250px;
            }

            .sidebar a span,
            .sidebar-header {
                opacity: 0;
                transition: opacity 0.3s;
            }

            .sidebar:hover a span,
            .sidebar:hover .sidebar-header {
                opacity: 1;
            }

            .main-content {
                margin-left: 70px;
                width: calc(100% - 70px);
            }

            .site-footer {
                padding-left: 70px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transform: translateX(-100%);
            }

            .sidebar.show {
                width: 250px;
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .site-footer {
                padding-left: 0;
            }

            .table-header {
                flex-direction: column;
                align-items: stretch;
            }

            .table-controls {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                max-width: 100%;
            }

            .entries-filter {
                justify-content: center;
            }
        }

        .mobile-menu-btn {
            display: none;
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- Navbar --}}
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ISUN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex align-items-center ms-auto">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white d-flex align-items-center gap-2"
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-5"></i>
                        <span>{{ auth()->user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/profile"><i class="bi bi-pencil-square me-2"></i> Edit Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="#"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

{{-- Wrapper: Sidebar + Konten --}}
<div class="wrapper">

    {{-- Sidebar --}}
    <div id="sidebar" class="sidebar">
        <h5 class="text-center px-3 mb-2">Menu Utama</h5>

        {{-- Dashboard --}}
        <a href="{{ route('manajemen.dashboard') }}"
           class="{{ request()->routeIs('manajemen.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        {{-- ✅ Agenda: aktif HANYA di halaman agenda (bukan trash) --}}
        <a href="{{ route('agenda.index') }}"
           class="{{ request()->routeIs('agenda.index') || request()->routeIs('agenda.create') || request()->routeIs('agenda.edit') || request()->routeIs('agenda.show') ? 'active' : '' }}">
            <i class="fas fa-calendar-day"></i> Agenda
        </a>

        {{-- ✅ Trash: aktif HANYA di halaman trash --}}
        <a href="{{ route('agenda.trash') }}"
           class="{{ request()->routeIs('agenda.trash') ? 'active' : '' }}">
            <i class="fas fa-trash-alt"></i> Trash
        </a>

        <li class="menu-title">MANAJEMEN</li>

        {{-- Dropdown User --}}
        <li class="sidebar-dropdown {{ request()->is('manajemen/user*') ? 'open' : '' }}">
            <a href="#">
                <span>
                    <i class="bi bi-people"></i> User
                    <i class="bi bi-chevron-down arrow"></i>
                </span>
            </a>
            <ul class="dropdown-menu-custom">
                <li><a href="{{ url('manajemen/user-skpd') }}"
                       class="{{ request()->is('manajemen/user-skpd*') ? 'active' : '' }}">User SKPD</a></li>
                <li><a href="{{ url('manajemen/user-non-skpd') }}"
                       class="{{ request()->is('manajemen/user-non-skpd*') ? 'active' : '' }}">User Non SKPD</a></li>
                <li><a href="{{ url('manajemen/user-groups') }}"
                       class="{{ request()->is('manajemen/user-groups*') ? 'active' : '' }}">User Group</a></li>
                <li><a href="{{ url('manajemen/user-permission') }}"
                       class="{{ request()->is('manajemen/user-permission*') ? 'active' : '' }}">User Permission</a></li>
            </ul>
        </li>

        {{-- Dropdown Organisasi --}}
        <li class="sidebar-dropdown {{ request()->is('manajemen/skpd*') || request()->is('manajemen/non-skpd*') ? 'open' : '' }}">
            <a href="#">
                <span>
                    <i class="bi bi-people"></i> Organisasi
                    <i class="bi bi-chevron-down arrow"></i>
                </span>
            </a>
            <ul class="dropdown-menu-custom">
                <li><a href="{{ url('manajemen/skpd') }}"
                       class="{{ request()->is('manajemen/skpd*') ? 'active' : '' }}">SKPD</a></li>
                <li><a href="{{ url('manajemen/non-skpd') }}"
                       class="{{ request()->is('manajemen/non-skpd*') ? 'active' : '' }}">Non SKPD</a></li>
            </ul>
        </li>

        {{-- Pengaturan --}}
        <li>
            <a href="/manajemen/pengaturan"
               class="{{ request()->is('manajemen/pengaturan*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> Pengaturan
            </a>
        </li>

        <div class="mt-2 px-3">
            <a href="{{ route('display') }}" class="btn-display {{ request()->routeIs('display.*') ? 'active' : '' }}">
                <i class="fas fa-desktop"></i> <span>Buka Display</span>
            </a>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="main-content" id="mainContent">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

</div>

{{-- Footer --}}
<footer class="site-footer">
    <p>Hak Cipta Pemerintah Kota Cirebon - 2025 - 2026</p>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const sidebar = document.getElementById('sidebar');

        // Mobile: tutup sidebar kalau klik di luar
        document.addEventListener('click', function (event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            if (window.innerWidth <= 768 && !isClickInsideSidebar && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        });

        // Mobile: tutup sidebar setelah klik link
        document.querySelectorAll('.sidebar a').forEach(link => {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('show');
                }
            });
        });

        // Auto close alert setelah 5 detik
        setTimeout(function () {
            document.querySelectorAll('.alert').forEach(alert => {
                new bootstrap.Alert(alert).close();
            });
        }, 5000);

        // Sidebar dropdown toggle
        document.querySelectorAll('.sidebar-dropdown > a').forEach(function (menu) {
            menu.addEventListener('click', function (e) {
                e.preventDefault();
                this.parentElement.classList.toggle('open');
            });
        });

    });
</script>
@stack('scripts')
</body>
</html>