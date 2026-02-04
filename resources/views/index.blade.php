<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ISUN</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #3943ae;
            --secondary-color: #4e73df;
            --accent-color: #3b5bdb;
            --light-bg: #f8f9fa;
            --border-radius: 10px;
            --box-shadow: 0 4px 6px rgba(21, 21, 21, 0.098);
        }
        
        .navbar {
             background-color: #2741a7;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333333;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            letter-spacing: 1px;
        }
        
        .sidebar {
            background-color: var(--primary-color);
            min-height: calc(100vh - 56px);
            color: white;
            padding: 20px 0;
            box-shadow: var(--box-shadow);
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
            background-color: rgba(255, 255, 255, 0.075);
            border-left: 4px solid var(--secondary-color);
            padding-left: 25px;
        }
        
        .sidebar i {
            width: 25px;
            margin-right: 10px;
        }
        
        .main-content {
            padding: 20px;
        }
        
        .dashboard-header {
            margin-bottom: 30px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 15px;
        }
        
        .stat-card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px 20px;
            margin-bottom: 25px;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s, box-shadow 0.3s;
            border-top: 5px solid var(--secondary-color);
            text-align: center;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.091);
        }
        
        .stat-card:nth-child(2) {
            border-top-color: #2ecc71;
        }
        
        .stat-card:nth-child(3) {
            border-top-color: #e74c3c;
        }
        
        .stat-card:nth-child(4) {
            border-top-color: #f39c12;
        }
        
        .stat-number {
            font-size: 2.8rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 1rem;
            color: #7f8c8d;
            font-weight: 500;
        }
        
        .stat-icon {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }
        
        .dashboard-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .display-toggle {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .display-toggle:hover {
            background-color: #322bc0;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                margin-bottom: 20px;
            }
            
            .stat-card {
                margin-bottom: 15px;
            }
 


        }
    </style>
</head>
<body>

<nav id="navbar" class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class=" "></i>isun
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
             <div class="d-flex align-items-center ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person me-1"></i> Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/profile"><i class="bi bi-pencil-square me-2"></i> Edit Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-3 sidebar">
                <h5 class=" text-center px-3 mb-2">Menu Utama</h5>
                <a href="/" class="active">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="/agenda">
                    <i class="fas fa-calendar-day"></i> Agenda
                </a>
               
                
                    <div class="mt-2 px-3">
                        <button class="btn btn-outline-light w-100 display-toggle">
                            <i class="fas fa-desktop me-2"></i> Buka Display
                        </button>
                    </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-10 col-md-9 main-content">
                <div class="dashboard-header">
                    <h1 class="dashboard-title">Dashboard</h1>
                    <p class="text-muted">Ringkasan informasi agenda dan aktivitas</p>
                </div>
                
                <div class="row">
                    <!-- Stat Cards -->
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <div class="stat-number">0</div>
                            <div class="stat-label">Agenda Hari Ini</div>
                            <div class="mt-3">
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Tidak ada agenda hari ini</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-week"></i>
                            </div>
                            <div class="stat-number">0</div>
                            <div class="stat-label">Agenda Bulan Ini</div>
                            <div class="mt-3">
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Tidak ada agenda bulan ini</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="stat-number">0</div>
                            <div class="stat-label">Agenda Tahun Ini</div>
                            <div class="mt-3">
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i> 0 agenda tersedia</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="stat-number">0</div>
                            <div class="stat-label">Seluruh Agenda</div>
                            <div class="mt-3">
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Total semua agenda</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- <!--  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Tambahkan sedikit interaktivitas
        document.addEventListener('DOMContentLoaded', function() {
            // Efek hover untuk kartu statistik
            const statCards = document.querySelectorAll('.stat-card');
            
            statCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Tombol Buka Display
            const displayBtn = document.querySelector('.display-toggle');
            displayBtn.addEventListener('click', function() {
                alert('Mode display telah diaktifkan! Dashboard akan ditampilkan dalam mode layar penuh.');
            });
            
            // Update waktu terakhir refresh
            const updateTime = document.querySelector('.update-time');
            if (updateTime) {
                const now = new Date();
                updateTime.textContent = now.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
        });
    </script>
</body>
</html>