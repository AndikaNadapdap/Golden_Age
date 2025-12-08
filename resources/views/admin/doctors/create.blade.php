<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Dokter Baru - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2><i class="bi bi-person-plus me-2"></i>Tambah Dokter Baru</h2>
                    <p class="mb-0">Buat akun dokter baru</p>
                </div>
                <a href="{{ route('admin.doctors.index') }}" class="btn btn-light">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body p-4">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Catatan:</strong> Anda hanya perlu membuat akun login untuk dokter. 
                            Dokter akan melengkapi profile profesional mereka sendiri setelah login pertama kali.
                        </div>

                        <form action="{{ route('admin.doctors.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label">Nama Lengkap Dokter <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="Contoh: Dr. Ahmad Hidayat, Sp.A"
                                           required>
                                </div>
                                @error('name')
                                    <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Contoh: dr.ahmad@example.com"
                                           required>
                                </div>
                                @error('email')
                                    <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                @enderror
                                <small class="text-muted">Email ini akan digunakan dokter untuk login</small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password" 
                                           placeholder="Minimal 6 karakter"
                                           required
                                           minlength="6">
                                </div>
                                @error('password')
                                    <div class="text-danger mt-1"><small>{{ $message }}</small></div>
                                @enderror
                                <small class="text-muted">Berikan password ini kepada dokter</small>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i>Buat Akun Dokter
                                </button>
                                <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h6><i class="bi bi-lightbulb me-2"></i>Tips</h6>
                        <ul class="small mb-0">
                            <li>Pastikan email dokter valid dan belum terdaftar</li>
                            <li>Gunakan password yang mudah diingat dokter</li>
                            <li>Setelah akun dibuat, berikan email dan password kepada dokter</li>
                            <li>Dokter akan melengkapi profile profesional setelah login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
