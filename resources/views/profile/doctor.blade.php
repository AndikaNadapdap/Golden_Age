<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Dokter - Panduan 1000 Hari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 2rem 0;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }
        .badge-status {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }
    </style>
</head>
<body>
    <div class="profile-header">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="me-4">
                    <div class="bg-white rounded-circle p-3">
                        <i class="bi bi-hospital-fill text-success" style="font-size: 3rem;"></i>
                    </div>
                </div>
                <div>
                    <h2 class="mb-0">{{ $user->name }}</h2>
                    <p class="mb-0"><i class="bi bi-envelope me-2"></i>{{ $user->email }}</p>
                    <div class="mt-2">
                        <span class="badge bg-light text-dark me-2">
                            <i class="bi bi-hospital me-1"></i>Dokter
                        </span>
                        @if($user->status == 'approved')
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle me-1"></i>Terverifikasi
                            </span>
                        @elseif($user->status == 'pending')
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-clock me-1"></i>Menunggu Verifikasi
                            </span>
                        @else
                            <span class="badge bg-danger">
                                <i class="bi bi-x-circle me-1"></i>Ditolak
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($user->status == 'pending')
            <div class="alert alert-warning">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Akun Anda sedang dalam proses verifikasi.</strong> 
                Admin akan segera meninjau data Anda. Mohon tunggu konfirmasi lebih lanjut.
            </div>
        @endif

        <div class="row">
            <!-- Account Info -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="bi bi-person-circle me-2"></i>Informasi Akun
                        </h5>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-3"><i class="bi bi-card-text me-2"></i>Nomor STR</h6>
                        <p class="text-muted mb-0">{{ $profile->str_number ?? '-' }}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-house me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>

            <!-- Professional Info -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="bi bi-briefcase me-2"></i>Informasi Profesional
                        </h5>

                        @if($profile)
                            <form action="{{ route('profile.doctor.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Nomor STR (Surat Tanda Registrasi) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="str_number" value="{{ $profile->str_number == '-' ? '' : $profile->str_number }}" required placeholder="Contoh: STR-12345678">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Spesialisasi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="specialization" value="{{ $profile->specialization == '-' ? '' : $profile->specialization }}" required placeholder="Contoh: Spesialis Anak">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Rumah Sakit/Klinik <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="hospital_name" value="{{ $profile->hospital_name == '-' ? '' : $profile->hospital_name }}" required placeholder="Contoh: RS Harapan Sehat">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="phone_number" value="{{ $profile->phone_number == '-' ? '' : $profile->phone_number }}" required placeholder="Contoh: 081234567890">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Pengalaman (tahun) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="years_of_experience" value="{{ $profile->years_of_experience }}" required min="0">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Bio / Deskripsi</label>
                                    <textarea class="form-control" name="bio" rows="4" placeholder="Ceritakan tentang diri Anda, keahlian, dan pengalaman...">{{ $profile->bio }}</textarea>
                                </div>

                                @if($profile->str_number == '-' || $profile->specialization == '-')
                                    <div class="alert alert-warning">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        <strong>Profile Belum Lengkap!</strong> Silakan lengkapi data profesional Anda.
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save me-2"></i>{{ $profile->str_number == '-' ? 'Simpan Profile' : 'Update Profile' }}
                                </button>
                            </form>
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                Data profile profesional belum tersedia.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Statistics Card -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="bi bi-graph-up me-2"></i>Statistik
                        </h5>
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="p-3">
                                    <i class="bi bi-hospital text-success" style="font-size: 2rem;"></i>
                                    <h4 class="mt-2 mb-0">{{ $profile->hospital_name ?? '-' }}</h4>
                                    <small class="text-muted">Rumah Sakit</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3">
                                    <i class="bi bi-award text-warning" style="font-size: 2rem;"></i>
                                    <h4 class="mt-2 mb-0">{{ $profile->years_of_experience ?? 0 }}</h4>
                                    <small class="text-muted">Tahun Pengalaman</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3">
                                    <i class="bi bi-briefcase text-primary" style="font-size: 2rem;"></i>
                                    <h4 class="mt-2 mb-0">{{ $profile->specialization ?? '-' }}</h4>
                                    <small class="text-muted">Spesialisasi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($profile && $profile->bio)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            <i class="bi bi-person-lines-fill me-2"></i>Tentang Saya
                        </h5>
                        <p class="text-muted">{{ $profile->bio }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
