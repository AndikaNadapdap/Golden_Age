<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Dokter - Admin</title>
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
        .badge-complete {
            background-color: #10b981;
        }
        .badge-incomplete {
            background-color: #f59e0b;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2><i class="bi bi-hospital me-2"></i>Manajemen Dokter</h2>
                    <p class="mb-0">Kelola akun dokter di platform</p>
                </div>
                <a href="{{ route('home') }}" class="btn btn-light">
                    <i class="bi bi-house me-2"></i>Kembali ke Home
                </a>
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

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Daftar Dokter</h5>
                        <small class="text-muted">Total: {{ $doctors->count() }} dokter</small>
                    </div>
                    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Dokter Baru
                    </a>
                </div>
            </div>
        </div>

        @if($doctors->count() > 0)
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Status Profile</th>
                                    <th>Spesialisasi</th>
                                    <th>Rumah Sakit</th>
                                    <th>Pengalaman</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($doctors as $index => $doctor)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $doctor->name }}</strong>
                                        </td>
                                        <td>{{ $doctor->email }}</td>
                                        <td>
                                            @if($doctor->doctorProfile && $doctor->doctorProfile->str_number != '-')
                                                <span class="badge badge-complete">
                                                    <i class="bi bi-check-circle me-1"></i>Lengkap
                                                </span>
                                            @else
                                                <span class="badge badge-incomplete">
                                                    <i class="bi bi-exclamation-circle me-1"></i>Belum Lengkap
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $doctor->doctorProfile && $doctor->doctorProfile->specialization != '-' ? $doctor->doctorProfile->specialization : '-' }}
                                        </td>
                                        <td>
                                            {{ $doctor->doctorProfile && $doctor->doctorProfile->hospital_name != '-' ? $doctor->doctorProfile->hospital_name : '-' }}
                                        </td>
                                        <td>
                                            {{ $doctor->doctorProfile ? $doctor->doctorProfile->years_of_experience . ' tahun' : '-' }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#resetPasswordModal{{ $doctor->id }}">
                                                    <i class="bi bi-key"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $doctor->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Reset Password Modal -->
                                    <div class="modal fade" id="resetPasswordModal{{ $doctor->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Reset Password - {{ $doctor->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('admin.doctors.reset-password', $doctor->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Password Baru</label>
                                                            <input type="password" class="form-control" name="password" required minlength="6" placeholder="Minimal 6 karakter">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Reset Password</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Form -->
                                    <form id="deleteForm{{ $doctor->id }}" action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                    <h5 class="mt-3">Belum Ada Dokter Terdaftar</h5>
                    <p class="text-muted">Klik tombol "Tambah Dokter Baru" untuk membuat akun dokter.</p>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus dokter ini? Semua data terkait akan dihapus!')) {
                document.getElementById('deleteForm' + id).submit();
            }
        }
    </script>
</body>
</html>
<<<<<<< HEAD
=======
 
>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9
