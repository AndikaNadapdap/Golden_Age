<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Paduan 1000 Hari</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #0EA5E9 0%, #06B6D4 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            padding: 20px 40px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 45px;
            height: 45px;
            background: #5CE1E6;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .logo i {
            color: white;
        }

        .header-text h1 {
            color: #1e293b;
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .header-text p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .main-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            padding: 48px;
            width: 100%;
            max-width: 520px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background: #E3F5FF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }

        .icon-circle i {
            font-size: 36px;
            color: #2E90FA;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 32px;
        }

        .form-label {
            color: #1e293b;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-group-text {
            background-color: #f8fafc;
            border-right: 0;
            color: #64748b;
        }

        .form-control {
            border-left: 0;
            padding: 12px 16px;
        }

        .form-control:focus {
            border-color: #2E90FA;
            box-shadow: 0 0 0 0.2rem rgba(46, 144, 250, 0.15);
        }

        .input-group:focus-within .input-group-text {
            border-color: #2E90FA;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            z-index: 10;
            padding: 4px 8px;
        }

        .password-toggle:hover {
            color: #2E90FA;
        }

        .password-hint {
            font-size: 12px;
            color: #64748b;
            margin-top: 4px;
        }

        .form-check-input:checked {
            background-color: #2E90FA;
            border-color: #2E90FA;
        }

        .form-check-label {
            color: #475569;
            font-size: 14px;
        }

        .form-check-label a {
            color: #2E90FA;
            text-decoration: none;
            font-weight: 500;
        }

        .form-check-label a:hover {
            text-decoration: underline;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2E90FA 0%, #1d4ed8 100%);
            border: none;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(46, 144, 250, 0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 24px;
            color: #64748b;
            font-size: 14px;
        }

        .login-link a {
            color: #2E90FA;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="d-flex align-items-center gap-3">
            <div class="logo">
                <i class="bi bi-heart-fill text-white fs-4"></i>
            </div>
            <div class="header-text">
                <h1>Panduan 1000 Hari</h1>
                <p>Panduan Tumbuh Kembang Anak</p>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="register-card">
            <div class="icon-circle">
                <i class="bi bi-person-plus-fill"></i>
            </div>

            <h2>Bergabung Sekarang</h2>
            <p class="subtitle">Daftarkan akun untuk mendampingi 1000 hari pertama buah hati Anda</p>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" 
                               class="form-control" 
                               name="name" 
                               id="name" 
                               placeholder="Masukkan nama lengkap Anda"
                               value="{{ old('name') }}" 
                               required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" 
                               class="form-control" 
                               name="email" 
                               id="email" 
                               placeholder="Masukkan email Anda"
                               value="{{ old('email') }}" 
                               required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group position-relative">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" 
                               class="form-control" 
                               name="password" 
                               id="password" 
                               placeholder="Minimal 6 karakter"
                               required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
                            <i class="bi bi-eye" id="toggleIcon1"></i>
                        </button>
                    </div>
                    <div class="password-hint">Password minimal 6 karakter</div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <div class="input-group position-relative">
                        <span class="input-group-text">
                            <i class="bi bi-shield-lock"></i>
                        </span>
                        <input type="password" 
                               class="form-control" 
                               name="password_confirmation" 
                               id="password_confirmation" 
                               placeholder="Ulangi password Anda"
                               required>
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                            <i class="bi bi-eye" id="toggleIcon2"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-person-plus me-2"></i>
                    Daftar Sekarang
                </button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk Sekarang</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>
