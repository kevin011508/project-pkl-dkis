<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun User - ISUN</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #0e61b4;
            --secondary-color: #3498db;
            --success-color: #2ecc71;
            --light-bg: #f8f9fa;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(3, 3, 3, 0.1);
        }
         .navbar {
             background-color: #4965d4;
        }
        
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #343434;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            letter-spacing: 1px;
        }
        
        .edit-account-container {
            max-width: 800px;
            margin: 0 auto;
            flex: 1;
        }
        
        .edit-account-card {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--box-shadow);
            margin-top: 30px;
            margin-bottom: 30px;
        }
        
        .page-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-bg);
        }
        
        .page-title i {
            color: var(--secondary-color);
            margin-right: 10px;
        }
        
        .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            border-radius: var(--border-radius);
            padding: 10px 15px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }
        
        .password-toggle {
            cursor: pointer;
            color: #777;
            transition: color 0.3s;
        }
        
        .password-toggle:hover {
            color: var(--secondary-color);
        }
        
        .current-value {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-radius: var(--border-radius);
            border: 1px solid #e9ecef;
            margin-bottom: 15px;
            font-family: monospace;
        }
        
        .current-value-label {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 5px;
        }
        
        .btn-kembali {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .btn-kembali:hover {
            background-color: #5a6268;
            color: white;
        }
        
        .btn-simpan {
            background-color: var(--success-color);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .btn-simpan:hover {
            background-color: #27ae60;
            color: white;
        }
        
        .form-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .form-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .form-section-title i {
            margin-right: 10px;
            color: var(--secondary-color);
        }
        
        .alert-info {
            background-color: #e8f4fc;
            border-color: #b6e0fe;
            color: #055685;
            border-radius: var(--border-radius);
        }
        
        .user-info-badge {
            display: inline-block;
            background-color: #e8f4fc;
            color: var(--secondary-color);
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.85rem;
            margin-top: 5px;
        }
        
        .user-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--secondary-color);
            margin: 0 auto 20px;
            display: block;
        }
        
        @media (max-width: 768px) {
            .edit-account-card {
                padding: 20px;
            }
            
            .btn-action-group {
                flex-direction: column;
            }
            
            .btn-action-group .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
<nav id="navbar" class="navbar navbar-expand-lg navbar-dark ">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-chart-line me-2"></i>I S U N
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="fas fa-tachometer-alt me-1"></i> Dashboard</a>
                    </li>
                        <a class="nav-link active" href="/profile"><i class="fas fa-user-edit me-1"></i> Edit Akun</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container edit-account-container">
        <div class="edit-account-card">
            <h1 class="page-title">
                <i class="fas fa-user-edit"></i> Edit Akun 
            </h1>
            
            <!-- Informasi User Saat Ini -->
            <div class="alert alert-info">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-info-circle fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading">Informasi Akun</h5>
                        <p class="mb-0">Anda sedang mengedit akun untuk user: <strong>pkl_smkn1</strong>. Perubahan yang disimpan akan langsung berlaku.</p>
                    </div>
                </div>
            </div>
            
            <!-- Form Edit Akun -->
            <form id="editAccountForm">
                <!-- Section Username -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-user"></i> Username
                    </div>
                    
                    <div class="mb-3">
                        <div class="current-value-label">Username saat ini:</div>
                        <div class="current-value">pkl_smkn1</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Username Baru</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukkan username baru" value="pkl_smkn1">
                        <div class="form-text">Username harus terdiri dari 5-20 karakter (huruf, angka, underscore)</div>
                    </div>
                </div>
                
                <!-- Section Password -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-key"></i> Password
                    </div>
                    
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Password Saat Ini</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="currentPassword" placeholder="Masukkan password saat ini">
                            <span class="input-group-text password-toggle" id="toggleCurrentPassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="form-text">Diperlukan untuk konfirmasi perubahan</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="newPassword" placeholder="Masukkan password baru">
                            <span class="input-group-text password-toggle" id="toggleNewPassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="form-text">Password harus minimal 8 karakter dengan kombinasi huruf dan angka</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Ulangi password baru">
                            <span class="input-group-text password-toggle" id="toggleConfirmPassword">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Password Strength Indicator -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="form-label">Kekuatan Password:</span>
                            <span id="passwordStrengthText" class="fst-italic">Belum diisi</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div id="passwordStrengthBar" class="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                
              
                    
                  
                
                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between mt-4 pt-3 border-top btn-action-group">
                    <button type="button" class="btn btn-kembali" id="btnKembali">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </button>
                    
                    <div>
                        <button type="submit" class="btn btn-simpan">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    
    
        <!-- Bootstrap 5 JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Toggle password visibility
                const toggleCurrentPassword = document.getElementById('toggleCurrentPassword');
                const toggleNewPassword = document.getElementById('toggleNewPassword');
                const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
                const currentPasswordInput = document.getElementById('currentPassword');
                const newPasswordInput = document.getElementById('newPassword');
                const confirmPasswordInput = document.getElementById('confirmPassword');
                
                toggleCurrentPassword.addEventListener('click', function() {
                    const type = currentPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    currentPasswordInput.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
                
                toggleNewPassword.addEventListener('click', function() {
                    const type = newPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    newPasswordInput.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
                
                toggleConfirmPassword.addEventListener('click', function() {
                    const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    confirmPasswordInput.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
                
                // Password strength indicator
                newPasswordInput.addEventListener('input', function() {
                    const password = this.value;
                    const strengthBar = document.getElementById('passwordStrengthBar');
                    const strengthText = document.getElementById('passwordStrengthText');
                    
                    // Reset
                    strengthBar.style.width = '0%';
                    strengthBar.classList.remove('bg-danger', 'bg-warning', 'bg-info', 'bg-success');
                    
                    if (password.length === 0) {
                        strengthText.textContent = 'Belum diisi';
                        return;
                    }
                    
                    // Calculate password strength
                    let strength = 0;
                    
                    // Length check
                    if (password.length >= 8) strength += 25;
                    if (password.length >= 12) strength += 10;
                    
                    // Complexity checks
                    if (/[A-Z]/.test(password)) strength += 20;
                    if (/[a-z]/.test(password)) strength += 20;
                    if (/[0-9]/.test(password)) strength += 20;
                    if (/[^A-Za-z0-9]/.test(password)) strength += 15;
                    
                    // Cap at 100
                    strength = Math.min(strength, 100);
                    
                    // Update UI
                    strengthBar.style.width = strength + '%';
                    
                    if (strength < 40) {
                        strengthBar.classList.add('bg-danger');
                        strengthText.textContent = 'Lemah';
                    } else if (strength < 70) {
                        strengthBar.classList.add('bg-warning');
                        strengthText.textContent = 'Cukup';
                    } else if (strength < 90) {
                        strengthBar.classList.add('bg-info');
                        strengthText.textContent = 'Baik';
                    } else {
                        strengthBar.classList.add('bg-success');
                        strengthText.textContent = 'Sangat Kuat';
                    }
                });
                
                // Form submission
                const editAccountForm = document.getElementById('editAccountForm');
                editAccountForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Basic validation
                    const username = document.getElementById('username').value;
                    const newPassword = document.getElementById('newPassword').value;
                    const confirmPassword = document.getElementById('confirmPassword').value;
                    
                    // Check if passwords match
                    if (newPassword !== confirmPassword) {
                        alert('Password baru dan konfirmasi password tidak cocok!');
                        return;
                    }
                    
                    // Check password strength if new password is provided
                    if (newPassword.length > 0 && newPassword.length < 8) {
                        alert('Password baru harus minimal 8 karakter!');
                        return;
                    }
                    
                    // Show success message
                    alert('Perubahan akun user berhasil disimpan!');
                    
                    // In a real app, you would submit the form data to the server here
                    console.log('Form data:', {
                        username: username,
                        newPassword: newPassword ? '***' : '(tidak diubah)',
                        fullName: document.getElementById('fullName').value,
                        email: document.getElementById('email').value,
                        role: document.getElementById('role').value,
                        status: document.querySelector('input[name="status"]:checked').value
                    });
                });
                
                // Reset button
                const btnReset = document.getElementById('btnReset');
                btnReset.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin mengembalikan semua perubahan?')) {
                        document.getElementById('username').value = 'pkl_smkn1';
                        document.getElementById('currentPassword').value = '';
                        document.getElementById('newPassword').value = '';
                        document.getElementById('confirmPassword').value = '';
                        document.getElementById('fullName').value = 'User PKL SMKN 1';
                        document.getElementById('email').value = 'pkl_smkn1@example.id';
                        document.getElementById('role').value = 'user';
                        document.getElementById('statusActive').checked = true;
                        
                        // Reset password strength indicator
                        document.getElementById('passwordStrengthBar').style.width = '0%';
                        document.getElementById('passwordStrengthBar').className = 'progress-bar';
                        document.getElementById('passwordStrengthText').textContent = 'Belum diisi';
                        
                        alert('Form telah direset ke nilai default.');
                    }
                });
                
                // Back button
                const btnKembali = document.getElementById('btnKembali');
                btnKembali.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin kembali? Perubahan yang belum disimpan akan hilang.')) {
                        // In a real app, you would redirect to the previous page
                        window.location.href = '#'; // Replace with actual URL
                        alert('Mengembalikan ke halaman sebelumnya...');
                    }
                });
            });
        </script>
</body>
</html>