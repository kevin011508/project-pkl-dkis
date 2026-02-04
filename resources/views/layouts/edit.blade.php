<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISUN - CRUD Agenda</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            padding-top: 0;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            letter-spacing: 2px;
        }
        
        .header-section {
            background-color: white;
            padding: 20px 0;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .header-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .subtitle {
            color: #7f8c8d;
            font-size: 1.1rem;
        }
        
        .content-card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: var(--box-shadow);
            border-top: 4px solid var(--secondary-color);
        }
        
        .form-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
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
        }
        
        .form-control, .form-select {
            border-radius: 6px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .form-text {
            color: #7f8c8d;
            font-size: 0.85rem;
            margin-top: 5px;
        }
        
        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            padding: 10px 25px;
            border-radius: 6px;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }
        
        .btn-outline-secondary {
            padding: 10px 25px;
            border-radius: 6px;
            font-weight: 500;
        }
        
        .display-btn {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
            font-weight: 500;
        }
        
        .display-btn:hover {
            background-color: #c0392b;
            border-color: #c0392b;
            color: white;
        }
        
        .field-value {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-radius: 6px;
            border: 1px solid #eee;
            margin-bottom: 0;
        }
        
        .radio-group {
            display: flex;
            gap: 30px;
        }
        
        .form-check-input:checked {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .form-check-label {
            font-weight: 500;
        }
        
        .file-upload {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            background-color: #f8f9fa;
            transition: all 0.3s;
        }
        
        .file-upload:hover {
            border-color: var(--secondary-color);
            background-color: #f0f7ff;
        }
        
        .file-label {
            cursor: pointer;
            display: block;
        }
        
        .date-time-input {
            display: flex;
            gap: 15px;
        }
        
        .date-time-input .form-control {
            flex: 1;
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        @media (max-width: 768px) {
            .date-time-input {
                flex-direction: column;
                gap: 10px;
            }
            
            .radio-group {
                flex-direction: column;
                gap: 10px;
            }
            
            .content-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary-color);">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-calendar-check me-2"></i>ISUN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-calendar-event me-1"></i> Agenda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link display-btn btn btn-sm ms-2" href="#"><i class="bi bi-display me-1"></i> Buka Display</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Header -->
    <div class="header-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="header-title">Edit Agenda</h1>
                    <p class="subtitle">Ubah detail agenda yang sudah ada</p>
                </div>
                <div>
                    <a href="dashboard.html" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="content-card">
                    <form id="agendaForm">
                        <!-- Nama Agenda -->
                        <div class="form-section">
                            <label for="namaAgenda" class="form-label">Nama Agenda</label>
                            <input type="text" class="form-control" id="namaAgenda" 
                                   value="Audiensi & Ekspose Kerjasama Penataan Rencana" required>
                            <div class="form-text">Masukkan nama agenda yang jelas dan deskriptif.</div>
                        </div>
                        
                        <!-- Uraian / Deskripsi -->
                        <div class="form-section">
                            <label for="uraianAgenda" class="form-label">Uraian / Deskripsi</label>
                            <textarea class="form-control" id="uraianAgenda" rows="3">Penyelenggara: PT. Almajara Indo Tama</textarea>
                            <div class="form-text">Jelaskan detail dan tujuan dari agenda ini.</div>
                        </div>
                        
                        <!-- Lokasi -->
                        <div class="form-section">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" 
                                   value="Ruang Rapat Wali Kota Cirebon" required>
                        </div>
                        
                        <!-- Alamat -->
                        <div class="form-section">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" 
                                   value="Jl. Siliwangi No. 84 Kota Cirebon">
                            <div class="form-text">Masukkan alamat lengkap lokasi agenda.</div>
                        </div>
                        
                        <!-- Disposisi -->
                        <div class="form-section">
                            <label for="disposisi" class="form-label">Disposisi</label>
                            <select class="form-select" id="disposisi">
                                <option value="">Pilih disposisi...</option>
                                <option value="kabid_itik" selected>Kabid ITIK</option>
                                <option value="kabid_umum">Kabid Umum</option>
                                <option value="kabid_keuangan">Kabid Keuangan</option>
                                <option value="sekretaris">Sekretaris</option>
                                <option value="kepala_dinas">Kepala Dinas</option>
                            </select>
                        </div>
                        
                        <!-- Seragam -->
                        <div class="form-section">
                            <label for="seragam" class="form-label">Seragam</label>
                            <input type="text" class="form-control" id="seragam" 
                                   placeholder="Contoh: Batik, PDL, Formal">
                        </div>
                        
                        <!-- Tanggal dan Waktu -->
                        <div class="form-section">
                            <label class="form-label">Tanggal dan Waktu</label>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tanggalAwal" class="form-label">Tanggal Awal</label>
                                    <div class="date-time-input">
                                        <input type="date" class="form-control" id="tanggalAwal" value="2026-01-08">
                                        <input type="time" class="form-control" id="waktuAwal" value="13:00">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggalAkhir" class="form-label">Tanggal Akhir</label>
                                    <div class="date-time-input">
                                        <input type="date" class="form-control" id="tanggalAkhir">
                                        <input type="time" class="form-control" id="waktuAkhir">
                                    </div>
                                    <div class="checkbox-container mt-2">
                                        <input class="form-check-input" type="checkbox" id="selesai" checked>
                                        <label class="form-check-label" for="selesai">
                                            Selesai
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Lampiran / Berkas / Undangan -->
                        <div class="form-section">
                            <label class="form-label">Lampiran / Berkas / Undangan</label>
                            <div class="file-upload mb-3">
                                <label for="lampiran" class="file-label">
                                    <i class="bi bi-cloud-arrow-up display-4 text-secondary mb-3"></i>
                                    <p class="mb-1"><strong>Klik untuk memilih file</strong></p>
                                    <p class="text-muted mb-0">Unggah file undangan atau dokumen pendukung</p>
                                </label>
                                <input type="file" class="form-control d-none" id="lampiran">
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span id="fileName">Tidak ada file dipilih</span>
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="clearFile">
                                    <i class="bi bi-x-circle me-1"></i> Hapus
                                </button>
                            </div>
                        </div>
                        
                        <!-- Sifat Agenda -->
                        <div class="form-section">
                            <label class="form-label">Sifat Agenda</label>
                            <div class="radio-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sifatAgenda" id="publik">
                                    <label class="form-check-label" for="publik">
                                        Publik
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sifatAgenda" id="privat" checked>
                                    <label class="form-check-label" for="privat">
                                        Privat
                                    </label>
                                </div>
                            </div>
                            <div class="form-text">
                                <span class="text-info"><i class="bi bi-info-circle me-1"></i> Publik: Dapat dilihat oleh semua pengguna. Privat: Hanya dapat dilihat oleh pengguna tertentu.</span>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="form-section pt-3">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary" id="btnKembali">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </button>
                                <div>
                                    <button type="button" class="btn btn-outline-danger me-2" id="btnHapus">
                                        <i class="bi bi-trash me-1"></i> Hapus
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="btnSimpan">
                                        <i class="bi bi-check-circle me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Preview Section -->
                <div class="content-card mt-4">
                    <h5 class="mb-3" style="color: var(--primary-color);">
                        <i class="bi bi-eye me-2"></i>Preview Agenda
                    </h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Nama Agenda:</strong></p>
                            <p class="field-value" id="previewNama">Audiensi & Ekspose Kerjasama Penataan Rencana</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Lokasi:</strong></p>
                            <p class="field-value" id="previewLokasi">Ruang Rapat Wali Kota Cirebon</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Tanggal:</strong></p>
                            <p class="field-value" id="previewTanggal">8 Januari 2026, 13:00 WIB</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Status:</strong></p>
                            <p class="field-value"><span class="badge bg-success">Aktif</span></p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-outline-primary btn-sm" id="btnRefreshPreview">
                            <i class="bi bi-arrow-clockwise me-1"></i> Refresh Preview
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="mt-5 py-4" style="background-color: var(--primary-color); color: white;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2023 ISUN - Sistem Manajemen Agenda. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>Versi 2.1.0 | Terakhir diperbarui: Februari 2023</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File upload handling
            const fileInput = document.getElementById('lampiran');
            const fileName = document.getElementById('fileName');
            const clearFileBtn = document.getElementById('clearFile');
            const fileUploadArea = document.querySelector('.file-upload');
            
            fileUploadArea.addEventListener('click', function() {
                fileInput.click();
            });
            
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    fileName.textContent = this.files[0].name;
                    fileUploadArea.innerHTML = `
                        <i class="bi bi-file-earmark-check display-4 text-success mb-3"></i>
                        <p class="mb-1"><strong>${this.files[0].name}</strong></p>
                        <p class="text-muted mb-0">${(this.files[0].size / 1024).toFixed(2)} KB</p>
                    `;
                } else {
                    fileName.textContent = 'Tidak ada file dipilih';
                    resetFileUpload();
                }
            });
            
            clearFileBtn.addEventListener('click', function() {
                fileInput.value = '';
                fileName.textContent = 'Tidak ada file dipilih';
                resetFileUpload();
            });
            
            function resetFileUpload() {
                fileUploadArea.innerHTML = `
                    <label for="lampiran" class="file-label">
                        <i class="bi bi-cloud-arrow-up display-4 text-secondary mb-3"></i>
                        <p class="mb-1"><strong>Klik untuk memilih file</strong></p>
                        <p class="text-muted mb-0">Unggah file undangan atau dokumen pendukung</p>
                    </label>
                `;
            }
            
            // Preview functionality
            const btnRefreshPreview = document.getElementById('btnRefreshPreview');
            const previewNama = document.getElementById('previewNama');
            const previewLokasi = document.getElementById('previewLokasi');
            const previewTanggal = document.getElementById('previewTanggal');
            
            function updatePreview() {
                const nama = document.getElementById('namaAgenda').value;
                const lokasi = document.getElementById('lokasi').value;
                const tanggal = document.getElementById('tanggalAwal').value;
                const waktu = document.getElementById('waktuAwal').value;
                
                previewNama.textContent = nama || '-';
                previewLokasi.textContent = lokasi || '-';
                
                if (tanggal && waktu) {
                    const dateObj = new Date(tanggal + 'T' + waktu);
                    const options = { 
                        day: 'numeric', 
                        month: 'long', 
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    };
                    previewTanggal.textContent = dateObj.toLocaleDateString('id-ID', options);
                } else {
                    previewTanggal.textContent = '-';
                }
            }
            
            btnRefreshPreview.addEventListener('click', updatePreview);
            
            // Update preview on form change
            const formInputs = document.querySelectorAll('#agendaForm input, #agendaForm textarea, #agendaForm select');
            formInputs.forEach(input => {
                input.addEventListener('change', updatePreview);
                input.addEventListener('keyup', updatePreview);
            });
            
            // Form submission
            const agendaForm = document.getElementById('agendaForm');
            agendaForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validasi form
                const namaAgenda = document.getElementById('namaAgenda').value;
                const lokasi = document.getElementById('lokasi').value;
                
                if (!namaAgenda || !lokasi) {
                    alert('Harap isi nama agenda dan lokasi yang wajib diisi!');
                    return;
                }
                
                // Simulasi pengiriman data
                const btnSimpan = document.getElementById('btnSimpan');
                const originalText = btnSimpan.innerHTML;
                
                btnSimpan.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Menyimpan...';
                btnSimpan.disabled = true;
                
                setTimeout(() => {
                    alert('Agenda berhasil diperbarui!');
                    btnSimpan.innerHTML = originalText;
                    btnSimpan.disabled = false;
                    updatePreview();
                }, 1500);
            });
            
            // Button actions
            document.getElementById('btnKembali').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin kembali? Perubahan yang belum disimpan akan hilang.')) {
                    window.location.href = 'dashboard.html';
                }
            });
            
            document.getElementById('btnHapus').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus agenda ini? Tindakan ini tidak dapat dibatalkan.')) {
                    alert('Agenda berhasil dihapus!');
                    window.location.href = 'dashboard.html';
                }
            });
            
            // Initialize preview
            updatePreview();
            
            // Format tanggal untuk tampilan
            const tanggalAwal = document.getElementById('tanggalAwal');
            const waktuAwal = document.getElementById('waktuAwal');
            
            if (!tanggalAwal.value) {
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                tanggalAwal.value = tomorrow.toISOString().split('T')[0];
            }
            
            if (!waktuAwal.value) {
                waktuAwal.value = '09:00';
            }
        });
    </script>
</body>
</html>