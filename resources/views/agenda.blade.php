<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISUN</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color:  #3943ae;
            --secondary-color:  #4e73df;
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
            color: rgba(0, 0, 0, 0.842);~
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
            color: white;
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
</head>
<body>
    <!-- Navbar -->
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid">
            <button class="navbar-toggler mobile-menu-btn" type="button" id="sidebarToggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <a class="navbar-brand" href="#">
                <i class="bi bi-graph-up me-2"></i>ISUN
            </a>
            
            <div class="d-flex align-items-center ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person me-1"></i> Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle me-2"></i> Lihat Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-square me-2"></i> Edit Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-content">
            <div class="sidebar-header">
                <h5 class="sidebar-title">Menu Utama</h5>
            </div>
            
            <a href="/" class="active">
                <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
            </a>
            <a href="/agenda">
                <i class="bi bi-calendar-check"></i> <span>Agenda</span>
            </a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Tombol Rekap dan Tambah (DI LUAR table-container) -->
        <div style="margin-bottom: 20px;">
            <div class="d-flex justify-content-between align-items-center">

                <h3 class="mb-0 fw-bold">Agenda</h3>

                <div class="d-flex gap-2">
                <button class="btn btn-rekap">
                    <i class="bi bi-pie-chart me-2"></i> Rekap
                </button>
                <button class="btn btn-tambah">
                    <i class="bi bi-plus-circle me-2"></i> Tambah
                </button>
                </div>
            </div>
        </div>
        
        <!-- Table Container -->
        <div class="table-container">
            <!-- Kontrol di dalam table-container -->
            <div class="table-header">
                <!-- Tampilan Entri -->
                <div class="entries-filter">
                    <label for="entriesPerPage">Tampilan</label>
                    <select class="form-select form-select-sm" id="entriesPerPage" style="width: auto;">
                        <option value="10" selected>10 entri</option>
                        <option value="25">25 entri</option>
                        <option value="50">50 entri</option>
                        <option value="100">100 entri</option>
                    </select>
                </div>
                
                <!-- Search Box -->
                <div class="search-box">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Cari agenda...">
                    </div>
                </div>
            </div>
            
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Agenda</th>
                            <th width="150">Disposisi</th>
                            <th width="150">Mulai</th>
                            <th width="100">Selesai</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Row 1 -->
                        <tr>
                            <td>1</td>
                            <td>
                                <strong>Audiensi & Ekspose Kerjasama Penataan Rencana Penempatan Jaringan Utilitas Fiber Optik</strong>
                            </td>
                            <td>Kabid ITIK</td>
                            <td>
                                <div>2026-01-08</div>
                                <small class="text-muted">13:00:00</small>
                            </td>
                            <td>
                                <span class="badge bg-warning">Belum</span>
                            </td>
                            <td>
                                <button class="btn btn-detail btn-action" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-edit btn-action" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-hapus btn-action" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Row 2 -->
                        <tr>
                            <td>2</td>
                            <td>
                                <strong>Rapat Persiapan Penyusunan Laporan Keterangan Pertanggung Jawaban (LKPI) Wali Kota Cirebon Tahun 2025</strong>
                            </td>
                            <td>KA.DKIS</td>
                            <td>
                                <div>2026-01-07</div>
                                <small class="text-muted">13:00:00</small>
                            </td>
                            <td>
                                <span class="badge bg-success">Selesai</span>
                            </td>
                            <td>
                                <button class="btn btn-detail btn-action" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-edit btn-action" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-hapus btn-action" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Row 3 -->
                        <tr>
                            <td>3</td>
                            <td>
                                <strong>Orientasi Penyusunan RKPD Kota Cirebon Tahun 2027</strong>
                            </td>
                            <td>Sekdis & Kasubag Program</td>
                            <td>
                                <div>2026-01-07</div>
                                <small class="text-muted">08:30:00</small>
                            </td>
                            <td>
                                <span class="badge bg-info">Berjalan</span>
                            </td>
                            <td>
                                <button class="btn btn-detail btn-action" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-edit btn-action" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-hapus btn-action" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Row 4 -->
                        <tr>
                            <td>4</td>
                            <td>
                                <strong>RAPAT PARIPURNA DPRD</strong>
                            </td>
                            <td>KA.DKIS</td>
                            <td>
                                <div>2025-12-29</div>
                                <small class="text-muted">09:00:00</small>
                            </td>
                            <td>
                                <span class="badge bg-success">Selesai</span>
                            </td>
                            <td>
                                <button class="btn btn-detail btn-action" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-edit btn-action" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-hapus btn-action" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Row 5 -->
                        <tr>
                            <td>5</td>
                            <td>
                                <strong>Launching Penerapan Manajemen Talenta di Lingkungan Pemerintah Daerah Kota Cirebon</strong>
                            </td>
                            <td>KA.DKIS</td>
                            <td>
                                <div>2025-12-23</div>
                                <small class="text-muted">13:00:00</small>
                            </td>
                            <td>
                                <span class="badge bg-success">Selesai</span>
                            </td>
                            <td>
                                <button class="btn btn-detail btn-action" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-edit btn-action" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-hapus btn-action" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Row 6 -->
                        <tr>
                            <td>6</td>
                            <td>
                                <strong>Pelaksanaan Monitoring & Evaluasi Pengadaan Barang/Jasa Triwulan IV TA 2025</strong>
                            </td>
                            <td>Kasubag Program dan Pelaporan</td>
                            <td>
                                <div>2025-12-23</div>
                                <small class="text-muted">10:30:00</small>
                            </td>
                            <td>
                                <span class="badge bg-success">Selesai</span>
                            </td>
                            <td>
                                <button class="btn btn-detail btn-action" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-edit btn-action" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-hapus btn-action" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Row 7 -->
                        <tr>
                            <td>7</td>
                            <td>
                                <strong>Program Cirebon Menyapa RRI</strong>
                            </td>
                            <td>KA.DKIS</td>
                            <td>
                                <div>2025-12-23</div>
                                <small class="text-muted">10:00:00</small>
                            </td>
                            <td>
                                <span class="badge bg-success">Selesai</span>
                            </td>
                            <td>
                                <button class="btn btn-detail btn-action" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-edit btn-action" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-hapus btn-action" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Row 8 -->
                        <tr>
                            <td>8</td>
                            <td>
                                <strong>Rapat Evaluasi SIKOPER</strong>
                            </td>
                            <td>Egov</td>
                            <td>
                                <div>2025-12-23</div>
                                <small class="text-muted">08:30:00</small>
                            </td>
                            <td>
                                <span class="badge bg-success">Selesai</span>
                            </td>
                            <td>
                                <button class="btn btn-detail btn-action" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-edit btn-action" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-hapus btn-action" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Row 9 -->
                        <tr>
                            <td>9</td>
                            <td>
                                <strong>Upgrading Unit Pengumpul Zakat (UPZ) Se-Kota Cirebon</strong>
                            </td>
                            <td>Sekdis</td>
                            <td>
                                <div>2025-12-23</div>
                                <small class="text-muted">08:00:00</small>
                            </td>
                            <td>
                                <span class="badge bg-success">Selesai</span>
                            </td>
                            <td>
                                <button class="btn btn-detail btn-action" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-edit btn-action" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-hapus btn-action" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Row 10 -->
                        <tr>
                            <td>10</td>
                            <td>
                                <strong>Workshop Transformasi & Budaya Digital Direktorat Respositori Multimedia & Penerbitan Ilmiah BRIN</strong>
                            </td>
                            <td>Bidang Egov</td>
                            <td>
                                <div>2025-12-22</div>
                                <small class="text-muted">08:30:00</small>
                            </td>
                            <td>
                                <span class="badge bg-success">Selesai</span>
                            </td>
                            <td>
                                <button class="btn btn-detail btn-action" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-edit btn-action" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-hapus btn-action" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Info -->
            <div class="pagination-info text-center">
                Menampilkan 1 sampai 10 dari 2,980 entri
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0"><i class="bi bi-graph-up me-2"></i> ISUN - Sistem Informasi Agenda Terpadu</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">© 2023 ISUN. Hak Cipta Dilindungi. Versi 2.1.0</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar for mobile
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = sidebarToggle.contains(event.target);
                
                if (window.innerWidth <= 768 && !isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            });
            
            // Entries per page selector
            const entriesPerPage = document.getElementById('entriesPerPage');
            
            entriesPerPage.addEventListener('change', function() {
                const selectedValue = this.value;
                alert(`Menampilkan ${selectedValue} entri per halaman`);
            });
            
            // Search functionality
            const searchInput = document.querySelector('.search-box input');
            
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const searchTerm = this.value;
                    if (searchTerm.trim() !== '') {
                        alert(`Mencari agenda: "${searchTerm}"`);
                    }
                }
            });
            
            // Tambah button
            const tambahButton = document.querySelector('.btn-tambah');
            tambahButton.addEventListener('click', function() {
                alert('Membuka form tambah agenda baru');
            });
            
            // Rekap button
            const rekapButton = document.querySelector('.btn-rekap');
            rekapButton.addEventListener('click', function() {
                alert('Membuka halaman rekap agenda');
            });
            
            // Action buttons
            document.querySelectorAll('.btn-detail').forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const agendaName = row.querySelector('td:nth-child(2) strong').textContent;
                    alert(`Melihat detail agenda: ${agendaName}`);
                });
            });
            
            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const agendaName = row.querySelector('td:nth-child(2) strong').textContent;
                    alert(`Mengedit agenda: ${agendaName}`);
                });
            });
            
            document.querySelectorAll('.btn-hapus').forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const agendaName = row.querySelector('td:nth-child(2) strong').textContent;
                    
                    if (confirm(`Apakah Anda yakin ingin menghapus agenda: ${agendaName}?`)) {
                        alert(`Agenda "${agendaName}" berhasil dihapus`);
                    }
                });
            });
            
            // Auto-hide sidebar on mobile when clicking menu item
            document.querySelectorAll('.sidebar a').forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('show');
                    }
                });
            });
        });
    </script>
</body>
</html>