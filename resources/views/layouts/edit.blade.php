<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISUN - Edit Agenda</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --light-bg: #f8f9fa;
            --card-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            --hover-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            min-height: 100vh;
            padding-top: 70px;
        }
        
        /* Navbar Styling */
        .navbar {
            background: #3943ae;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.1);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            padding: 10px 0;
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            letter-spacing: 1px;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--primary-color) !important;
            padding: 10px 20px !important;
            border-radius: 30px;
            transition: all 0.3s ease;
            margin: 0 5px;
        }
        
        .nav-link:hover, .nav-link.active {
            background: linear-gradient(135deg, var(--secondary-color), #2c80c9);
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }
        
        .display-btn {
            background: linear-gradient(135deg, var(--accent-color), #c0392b) !important;
            border: none !important;
            border-radius: 30px !important;
            padding: 10px 25px !important;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease !important;
        }
        
        .display-btn:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4) !important;
        }
        
        /* Main Container */
        .main-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 30px;
            margin: 20px auto;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(255, 255, 255, 0.2);
            min-height: calc(100vh - 140px);
        }
        
        /* Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(0,0,0,0.1);
        }
        
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .page-title i {
            color: var(--secondary-color);
            font-size: 2.2rem;
        }
        
        /* Card Styling */
        .info-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }
        
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-title i {
            font-size: 1.3rem;
            color: var(--secondary-color);
        }
        
        /* Form Card */
        .form-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .form-section {
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid #eee;
        }
        
        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-label .required {
            color: var(--accent-color);
        }
        
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.2);
            transform: translateY(-1px);
        }
        
        .form-text {
            color: #7f8c8d;
            font-size: 0.85rem;
            margin-top: 5px;
            font-style: italic;
        }
        
        /* Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, var(--secondary-color), #2c80c9);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(149, 165, 166, 0.4);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, var(--accent-color), #c0392b);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
        }
        
        /* Radio & Checkbox */
        .form-check-input:checked {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .radio-group {
            display: flex;
            gap: 30px;
        }
        
        /* File Upload */
        .file-upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 40px 20px;
            text-align: center;
            background: #f8f9fa;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .file-upload-area:hover {
            border-color: var(--secondary-color);
            background: #e3f2fd;
            transform: translateY(-2px);
        }
        
        /* Alert */
        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: var(--card-shadow);
        }
        
        /* Preview Card */
        .preview-card {
            background: linear-gradient(135deg, var(--primary-color), #1a252f);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
        }
        
        .preview-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .preview-item {
            margin-bottom: 15px;
        }
        
        .preview-label {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-bottom: 5px;
        }
        
        .preview-value {
            font-size: 1.1rem;
            font-weight: 500;
        }
        
        .badge-status {
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                padding: 20px;
                margin: 10px;
            }
            
            .page-title {
                font-size: 1.6rem;
            }
            
            .radio-group {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('agenda.index') }}">
                <i class="bi bi-calendar-check me-2"></i>ISUN
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('agenda.index') }}">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="bi bi-calendar-event me-1"></i> Agenda
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Container -->
    <div class="container main-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">
                    <i class="bi bi-pencil-square"></i> Edit Agenda
                </h1>
                <p class="text-muted mb-0">Ubah detail agenda yang sudah ada</p>
            </div>
            <div>
                <a href="{{ route('agenda.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
        
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Terjadi kesalahan!</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <div class="row">
            <!-- Form Column -->
            <div class="col-lg-8">
                <div class="form-card">
                    <form action="{{ route('agenda.update', $agenda->id) }}" method="POST" enctype="multipart/form-data" id="agendaForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Nama Agenda -->
                        <div class="form-section">
                            <label for="nama_agenda" class="form-label">
                                <i class="bi bi-card-heading"></i> Nama Agenda
                                <span class="required">*</span>
                            </label>
                            <input type="text" class="form-control @error('nama_agenda') is-invalid @enderror" 
                                   id="nama_agenda" name="nama_agenda" 
                                   value="{{ old('nama_agenda', $agenda->nama_agenda) }}" required>
                            @error('nama_agenda')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Masukkan nama agenda yang jelas dan deskriptif</div>
                        </div>
                        
                        <!-- Penyelenggara & Deskripsi -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-section">
                                    <label for="penyelenggara" class="form-label">
                                        <i class="bi bi-building"></i> Penyelenggara
                                    </label>
                                    <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror" 
                                           id="penyelenggara" name="penyelenggara" 
                                           value="{{ old('penyelenggara', $agenda->penyelenggara) }}">
                                    @error('penyelenggara')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-section">
                                    <label for="deskripsi" class="form-label">
                                        <i class="bi bi-text-paragraph"></i> Deskripsi
                                    </label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                              id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Lokasi & Alamat -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-section">
                                    <label for="lokasi" class="form-label">
                                        <i class="bi bi-geo-alt"></i> Lokasi
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                           id="lokasi" name="lokasi" 
                                           value="{{ old('lokasi', $agenda->lokasi) }}" required>
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-section">
                                    <label for="alamat" class="form-label">
                                        <i class="bi bi-geo"></i> Alamat Lengkap
                                    </label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                              id="alamat" name="alamat" rows="3">{{ old('alamat', $agenda->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Disposisi & Seragam -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-section">
                                    <label for="disposisi" class="form-label">
                                        <i class="bi bi-person-badge"></i> Disposisi
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('disposisi') is-invalid @enderror" 
                                           id="disposisi" name="disposisi" 
                                           value="{{ old('disposisi', $agenda->disposisi) }}" required>
                                    @error('disposisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-section">
                                    <label for="seragam" class="form-label">
                                        <i class="bi bi-person-circle"></i> Seragam
                                    </label>
                                    <input type="text" class="form-control @error('seragam') is-invalid @enderror" 
                                           id="seragam" name="seragam" 
                                           value="{{ old('seragam', $agenda->seragam) }}"
                                           placeholder="Contoh: Batik, PDL, Formal">
                                    @error('seragam')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Tanggal & Waktu -->
                        <div class="form-section">
                            <label class="form-label">
                                <i class="bi bi-calendar-event"></i> Tanggal & Waktu
                                <span class="required">*</span>
                            </label>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_mulai" class="form-label">Mulai</label>
                                    <input type="datetime-local" class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                           id="tanggal_mulai" name="tanggal_mulai" 
                                           value="{{ old('tanggal_mulai', date('Y-m-d\TH:i', strtotime($agenda->tanggal_mulai))) }}" required>
                                    @error('tanggal_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_selesai" class="form-label">Selesai (Opsional)</label>
                                    <input type="datetime-local" class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                           id="tanggal_selesai" name="tanggal_selesai" 
                                           value="{{ old('tanggal_selesai', $agenda->tanggal_selesai ? date('Y-m-d\TH:i', strtotime($agenda->tanggal_selesai)) : '') }}">
                                    @error('tanggal_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" name="status_selesai" id="status_selesai" value="1"
                                               {{ old('status_selesai', $agenda->status == 'selesai') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status_selesai">
                                            <i class="bi bi-check-circle me-1"></i> Tandai sebagai selesai
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Lampiran File -->
                        <div class="form-section">
                            <label class="form-label">
                                <i class="bi bi-paperclip"></i> Lampiran / Berkas
                            </label>
                            <div class="file-upload-area mb-3" onclick="document.getElementById('lampiran').click()">
                                <i class="bi bi-cloud-arrow-up display-4 text-secondary mb-3"></i>
                                <p class="mb-1"><strong>Klik untuk memilih file</strong></p>
                                <p class="text-muted mb-0">Unggah file undangan atau dokumen pendukung</p>
                                <input type="file" class="form-control d-none @error('lampiran') is-invalid @enderror" 
                                       id="lampiran" name="lampiran" onchange="updateFileName()">
                            </div>
                            @error('lampiran')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            
                            @if($agenda->lampiran)
                                <div class="alert alert-info">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="bi bi-file-earmark me-2"></i>
                                            File saat ini: 
                                            <a href="{{ Storage::url($agenda->lampiran) }}" target="_blank" class="fw-bold">
                                                {{ basename($agenda->lampiran) }}
                                            </a>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="hapus_lampiran" id="hapus_lampiran" value="1">
                                            <label class="form-check-label text-danger" for="hapus_lampiran">
                                                <i class="bi bi-trash me-1"></i> Hapus file
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center">
                                    <small id="fileName" class="text-muted">Belum ada file yang dipilih</small>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Sifat Agenda -->
                        <div class="form-section">
                            <label class="form-label">
                                <i class="bi bi-eye"></i> Sifat Agenda
                                <span class="required">*</span>
                            </label>
                            <div class="radio-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sifat_agenda" id="publik" value="publik"
                                           {{ old('sifat_agenda', $agenda->sifat_agenda) == 'publik' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="publik">
                                        <i class="bi bi-globe me-2"></i> Publik
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sifat_agenda" id="privat" value="privat"
                                           {{ old('sifat_agenda', $agenda->sifat_agenda) == 'privat' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="privat">
                                        <i class="bi bi-lock me-2"></i> Privat
                                    </label>
                                </div>
                            </div>
                            @error('sifat_agenda')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div class="form-text mt-2">
                                <i class="bi bi-info-circle me-1"></i> 
                                <span class="text-info">Publik: Dapat dilihat semua pengguna. Privat: Hanya pengguna tertentu.</span>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="form-section pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('agenda.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-2"></i> Batal
                                </a>
                                <div>
                                    <button type="button" class="btn btn-danger me-2" onclick="confirmDelete()">
                                        <i class="bi bi-trash me-2"></i> Hapus
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-2"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Preview Column -->
            <div class="col-lg-4">
                <!-- Preview Card -->
                <div class="preview-card">
                    <h5 class="preview-title">
                        <i class="bi bi-eye"></i> Preview Agenda
                    </h5>
                    
                    <div class="preview-item">
                        <div class="preview-label">Nama Agenda</div>
                        <div class="preview-value" id="previewNama">{{ $agenda->nama_agenda }}</div>
                    </div>
                    
                    <div class="preview-item">
                        <div class="preview-label">Penyelenggara</div>
                        <div class="preview-value" id="previewPenyelenggara">{{ $agenda->penyelenggara ?? '-' }}</div>
                    </div>
                    
                    <div class="preview-item">
                        <div class="preview-label">Lokasi</div>
                        <div class="preview-value" id="previewLokasi">{{ $agenda->lokasi }}</div>
                    </div>
                    
                    <div class="preview-item">
                        <div class="preview-label">Waktu</div>
                        <div class="preview-value" id="previewWaktu">
                            {{ \Carbon\Carbon::parse($agenda->tanggal_mulai)->translatedFormat('l, d F Y H:i') }}
                        </div>
                    </div>
                    
                    <div class="preview-item">
                        <div class="preview-label">Status</div>
                        <div class="preview-value">
                            @if($agenda->status == 'selesai')
                                <span class="badge-status bg-success">Selesai</span>
                            @elseif($agenda->status == 'berjalan')
                                <span class="badge-status bg-warning text-dark">Berjalan</span>
                            @else
                                <span class="badge-status bg-secondary">Belum Dimulai</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="preview-item">
                        <div class="preview-label">Sifat Agenda</div>
                        <div class="preview-value">
                            @if($agenda->sifat_agenda == 'publik')
                                <span class="badge-status bg-info">Publik</span>
                            @else
                                <span class="badge-status bg-dark">Privat</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <button class="btn btn-outline-light btn-sm" onclick="updatePreview()">
                            <i class="bi bi-arrow-clockwise me-2"></i> Refresh Preview
                        </button>
                    </div>
                </div>
                
                <!-- Info Card -->
                <div class="info-card">
                    <h6 class="card-title">
                        <i class="bi bi-info-circle"></i> Informasi
                    </h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            <small>Pastikan semua data sudah benar sebelum menyimpan</small>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                            <small>Field dengan tanda * wajib diisi</small>
                        </li>
                        <li>
                            <i class="bi bi-clock text-info me-2"></i>
                            <small>Terakhir diubah: {{ $agenda->updated_at->translatedFormat('d F Y H:i') }}</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function updateFileName() {
            const fileInput = document.getElementById('lampiran');
            const fileNameElement = document.getElementById('fileName');
            
            if (fileInput.files.length > 0) {
                fileNameElement.textContent = fileInput.files[0].name;
                fileNameElement.className = 'text-success fw-bold';
            } else {
                fileNameElement.textContent = 'Belum ada file yang dipilih';
                fileNameElement.className = 'text-muted';
            }
        }
        
        function updatePreview() {
            // Update preview based on form values
            const namaAgenda = document.getElementById('nama_agenda').value;
            const penyelenggara = document.getElementById('penyelenggara').value;
            const lokasi = document.getElementById('lokasi').value;
            const tanggalMulai = document.getElementById('tanggal_mulai').value;
            
            if (namaAgenda) document.getElementById('previewNama').textContent = namaAgenda;
            if (penyelenggara) document.getElementById('previewPenyelenggara').textContent = penyelenggara;
            if (lokasi) document.getElementById('previewLokasi').textContent = lokasi;
            
            if (tanggalMulai) {
                const date = new Date(tanggalMulai);
                const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' };
                document.getElementById('previewWaktu').textContent = date.toLocaleDateString('id-ID', options);
            }
            
            // Show success message
            const alert = document.createElement('div');
            alert.className = 'alert alert-success alert-dismissible fade show mt-3';
            alert.innerHTML = `
                <i class="bi bi-check-circle-fill me-2"></i>
                Preview berhasil diperbarui!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.querySelector('.preview-card').appendChild(alert);
            
            // Auto remove alert after 3 seconds
            setTimeout(() => {
                alert.remove();
            }, 3000);
        }
        
        function confirmDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus agenda ini? Tindakan ini tidak dapat dibatalkan.')) {
                // Create a form for DELETE request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("agenda.destroy", $agenda->id) }}';
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        }
        
        // Set min date for tanggal_selesai based on tanggal_mulai
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalMulai = document.getElementById('tanggal_mulai');
            const tanggalSelesai = document.getElementById('tanggal_selesai');
            
            if (tanggalMulai && tanggalSelesai) {
                tanggalMulai.addEventListener('change', function() {
                    tanggalSelesai.min = this.value;
                    
                    // If selesai date is earlier than mulai date, reset it
                    if (tanggalSelesai.value && tanggalSelesai.value < this.value) {
                        tanggalSelesai.value = this.value;
                    }
                });
            }
            
            // Auto update preview when form changes
            const formInputs = document.querySelectorAll('#agendaForm input, #agendaForm textarea, #agendaForm select');
            formInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.id !== 'lampiran' && this.id !== 'hapus_lampiran') {
                        setTimeout(updatePreview, 300);
                    }
                });
            });
        });
    </script>
</body>
</html>