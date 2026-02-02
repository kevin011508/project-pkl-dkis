<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ISUN</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --border-radius: 10px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
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
            background-color: rgba(255, 255, 255, 0.1);
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
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
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
            background-color: #c0392b;
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-chart-line me-2"></i>I S U N
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-calendar-alt me-1"></i> Agenda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-cog me-1"></i> Pengaturan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-3 sidebar">
                <h5 class="px-3 mb-4">Menu Utama</h5>
                <a href="#" class="active">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#">
                    <i class="fas fa-calendar-day"></i> Agenda
                </a>
                <a href="#">
                    <i class="fas fa-calendar-week"></i> Buka Display
                </a>
                <a href="#">
                    <i class="fas fa-file-alt"></i> Laporan
                </a>
                <a href="#">
                    <i class="fas fa-users"></i> Pengguna
                </a>
                <a href="#">
                    <i class="fas fa-chart-bar"></i> Statistik
                </a>
                
                <div class="mt-5 px-3">
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
                            <div class="stat-number">3</div>
                            <div class="stat-label">Agenda Tahun Ini</div>
                            <div class="mt-3">
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i> 3 agenda tersedia</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="stat-number">2980</div>
                            <div class="stat-label">Seluruh Agenda</div>
                            <div class="mt-3">
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Total semua agenda</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Additional Content -->
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="fas fa-list-ul me-2"></i> Agenda Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i> Tidak ada agenda terbaru untuk ditampilkan.
                                </div>
                                <p class="text-muted">Agenda yang akan datang akan muncul di sini. Anda dapat menambahkan agenda baru melalui menu "Agenda".</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0"><i class="fas fa-bullhorn me-2"></i> Quick Actions</h5>
                            </div>
                            <div class="card-body">
                                <button class="btn btn-outline-primary w-100 mb-2">
                                    <i class="fas fa-plus-circle me-2"></i> Tambah Agenda
                                </button>
                                <button class="btn btn-outline-secondary w-100 mb-2">
                                    <i class="fas fa-print me-2"></i> Cetak Laporan
                                </button>
                                <button class="btn btn-outline-info w-100 mb-2">
                                    <i class="fas fa-sync-alt me-2"></i> Refresh Data
                                </button>
                                <button class="btn btn-outline-warning w-100">
                                    <i class="fas fa-cog me-2"></i> Pengaturan Display
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <footer class="mt-5 pt-4 border-top">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-muted">&copy; 2023 ISUN Dashboard. All rights reserved.</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="text-muted">Versi 1.0.0 | Terakhir diperbarui: 15 Oktober 2023</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
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