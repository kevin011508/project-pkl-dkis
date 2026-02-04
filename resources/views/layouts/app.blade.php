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
    <style>
        :root {
            --primary-color: #3943ae;
            --secondary-color: #4e73df;
            --success-color: #2ecc71;
            --light-bg: #f8f9fa;
            --border-radius: 10px;
            --box-shadow: 0 4px 6px rgba(42, 42, 44, 0.116);
        }
        
        .navbar {
            background-color: #2741a7;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333333;
            margin: 0;
            padding: 0;
        }
    
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            letter-spacing: 2px;
        }
        
        .sidebar {
            background-color: var(--primary-color);
            min-height: 100vh;
            color: white;
            padding: 0;
            position: fixed;
            width: 250px;
            left: 0;
            top: 56px;
            z-index: 1000;
            transition: all 0.3s;
        }
        
        .sidebar-content {
            padding: 20px 0;
            height: calc(100vh - 56px);
            overflow-y: auto;
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
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
            margin-top: 56px;
            min-height: calc(100vh - 56px);
            transition: margin-left 0.3s;
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
        
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1100;
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
        
        /* Responsive */
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
            }
            
            .sidebar:hover + .main-content {
                margin-left: 250px;
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
    <!-- Navbar -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler mobile-menu-btn" type="button" id="sidebarToggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <a class="navbar-brand" href="{{ route('index') }}">
                <i class="bi bi-graph-up me-2"></i>ISUN
            </a>
        </div>
    </nav>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-content">
            <div class="sidebar-header">
                <h5 class="sidebar-title">Menu Utama</h5>
            </div>
            
            <a href="{{ route('index') }}" class="{{ request()->routeIs('index') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
<!-- Di sidebar -->
<a href="{{ route('agenda.index') }}" class="{{ request()->routeIs('agenda.*') ? 'active' : '' }}">
    <i class="bi bi-calendar-check"></i> <span>Agenda</span>
</a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Flash Messages -->
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
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar for mobile
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const sidebar = document.getElementById('sidebar');
                const sidebarToggle = document.getElementById('sidebarToggle');
                
                if (!sidebar || !sidebarToggle) return;
                
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = sidebarToggle.contains(event.target);
                
                if (window.innerWidth <= 768 && !isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            });
            
            // Auto-hide sidebar on mobile when clicking menu item
            document.querySelectorAll('.sidebar a').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        const sidebar = document.getElementById('sidebar');
                        if (sidebar) {
                            sidebar.classList.remove('show');
                        }
                    }
                });
            });
            
            // Auto-dismiss alerts after 5 seconds
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
    @stack('scripts')
</body>
</html>