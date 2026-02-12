<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISUN - Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #3498db;
            --light-bg: #f8f9fa;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }
        
        .login-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 0.6s ease-out;
        }
        
        .login-header {
            background-color: #3943ae;
            color: white;
            padding: 25px 20px;
            text-align: center;
        }
        
        .login-header h1 {
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        
        .login-header p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 0;
        }
        
        .login-body {
            padding: 30px 25px;
        }
        
        .form-label {
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-right: none;
        }
        
        .password-toggle {
            cursor: pointer;
            border: 1px solid #ddd;
            border-left: none;
            background-color: #f8f9fa;
        }
        
        .btn-login {
            background-color: #3943ae;
            color: white;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            border: none;
            width: 100%;
            transition: all 0.3s;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            background-color: #3943ae;
            transform: translateY(-2px);
        }

        .alert {
            font-size: 0.9rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 576px) {
            .login-container { padding: 15px; }
            .login-body { padding: 25px 20px; }
            .login-header h1 { font-size: 1.8rem; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <img src="{{ asset('img/logo cirebon.png') }}" 
                alt="Logo" 
                style="width: 115px; height: auto; margin-bottom: 15px;">
                <h1>ISUN</h1>
                <p>Informasi Surat Undangan dan Kehadiran</p>
            </div>
            
            <!-- Body -->
            <div class="login-body">
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <!-- Tampilkan error jika login salah -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Username -->
                    <div class="mb-4">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username Anda" required>
                        </div>
                    </div>
                    
                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password Anda" required>
                        </div>
                    </div>
                    
                    <!-- Login Button -->
                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i> Masuk ke Sistem
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>
