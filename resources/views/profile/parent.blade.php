<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Orang Tua - Panduan 1000 Hari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-header {
            background: linear-gradient(135deg, #0EA5E9 0%, #06B6D4 100%);
            color: white;
            padding: 2rem 0;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }
        .child-card {
            transition: transform 0.3s;
        }
        .child-card:hover {
            transform: translateY(-5px);
        }
        .child-photo {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="profile-header">
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="me-4">
                    <div class="bg-white rounded-circle p-3">
                        <i class="bi bi-person-fill text-primary" style="font-size: 3rem;"></i>
                    </div>
                </div>
                <div>
                    <h2 class="mb-0">{{ $user->name }}</h2>
                    <p class="mb-0"><i class="bi bi-envelope me-2"></i>{{ $user->email }}</p>
                    <span class="badge bg-light text-dark mt-2">
                        <i class="bi bi-people-fill me-1"></i>Orang Tua
                    </span>
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

        <div class="row">
            <!-- Profile Info -->
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
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body text-center">
                        <button class="btn btn-outline-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#addChildModal">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Data Anak
                        </button>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-house me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>

            <!-- Children List -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">
                            <i class="bi bi-hearts me-2"></i>Data Anak ({{ $children->count() }})
                        </h5>

                        @if($children->count() == 0)
                            <div class="text-center py-5">
                                <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                                <p class="text-muted mt-3">Belum ada data anak. Klik tombol "Tambah Data Anak" untuk memulai.</p>
                            </div>
                        @else
                            <div class="row">
                                @foreach($children as $child)
                                    <div class="col-md-6 mb-3">
                                        <div class="card child-card h-100">
                                            <div class="card-body text-center">
                                                @if($child->photo)
                                                    <img src="{{ asset('storage/' . $child->photo) }}" alt="{{ $child->name }}" class="child-photo mb-3">
                                                @else
                                                    <div class="child-photo mb-3 mx-auto bg-light d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-person text-muted" style="font-size: 3rem;"></i>
                                                    </div>
                                                @endif
                                                
                                                <h6 class="mb-1">{{ $child->name }}</h6>
                                                <p class="text-muted small mb-2">
                                                    <i class="bi bi-calendar me-1"></i>{{ $child->birth_date->format('d M Y') }}
                                                </p>
                                                <span class="badge {{ $child->gender == 'laki-laki' ? 'bg-primary' : 'bg-danger' }} mb-2">
                                                    <i class="bi bi-gender-{{ $child->gender == 'laki-laki' ? 'male' : 'female' }} me-1"></i>{{ ucfirst($child->gender) }}
                                                </span>
                                                <p class="mb-2"><strong>Usia:</strong> {{ $child->age }}</p>
                                                
                                                @if($child->birth_weight || $child->birth_height)
                                                    <hr>
                                                    <small class="text-muted">
                                                        @if($child->birth_weight)
                                                            <i class="bi bi-heart-pulse me-1"></i>{{ $child->birth_weight }} kg
                                                        @endif
                                                        @if($child->birth_height)
                                                            <i class="bi bi-rulers ms-2 me-1"></i>{{ $child->birth_height }} cm
                                                        @endif
                                                    </small>
                                                @endif

                                                <div class="mt-3">
                                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editChildModal{{ $child->id }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $child->id }})">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Child Modal -->
                                    <div class="modal fade" id="editChildModal{{ $child->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Data Anak</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('profile.child.update', $child->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Anak</label>
                                                            <input type="text" class="form-control" name="name" value="{{ $child->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Tanggal Lahir</label>
                                                            <input type="date" class="form-control" name="birth_date" value="{{ $child->birth_date->format('Y-m-d') }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Jenis Kelamin</label>
                                                            <select class="form-select" name="gender" required>
                                                                <option value="laki-laki" {{ $child->gender == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                                <option value="perempuan" {{ $child->gender == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                            </select>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Berat Lahir (kg)</label>
                                                                <input type="number" step="0.01" class="form-control" name="birth_weight" value="{{ $child->birth_weight }}">
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Tinggi Lahir (cm)</label>
                                                                <input type="number" step="0.01" class="form-control" name="birth_height" value="{{ $child->birth_height }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Golongan Darah</label>
                                                            <input type="text" class="form-control" name="blood_type" value="{{ $child->blood_type }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Foto Anak</label>
                                                            <input type="file" class="form-control" name="photo" accept="image/*">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Catatan</label>
                                                            <textarea class="form-control" name="notes" rows="3">{{ $child->notes }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Form -->
                                    <form id="deleteForm{{ $child->id }}" action="{{ route('profile.child.delete', $child->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Child Modal -->
    <div class="modal fade" id="addChildModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Anak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('profile.child.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Anak <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" max="{{ date('Y-m-d') }}" required>
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select @error('gender') is-invalid @enderror" name="gender" required>
                                <option value="">Pilih...</option>
                                <option value="laki-laki" {{ old('gender') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Berat Lahir (kg)</label>
                                <input type="number" step="0.01" class="form-control" name="birth_weight" placeholder="Contoh: 3.2">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tinggi Lahir (cm)</label>
                                <input type="number" step="0.01" class="form-control" name="birth_height" placeholder="Contoh: 50">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Golongan Darah</label>
                            <input type="text" class="form-control" name="blood_type" placeholder="Contoh: O+">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Anak</label>
                            <input type="file" class="form-control" name="photo" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Catatan tambahan tentang anak..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data anak ini?')) {
                document.getElementById('deleteForm' + id).submit();
            }
        }

        // Auto show modal jika ada error validasi
        @if ($errors->any())
            var addChildModal = new bootstrap.Modal(document.getElementById('addChildModal'));
            addChildModal.show();
        @endif
    </script>
</body>
</html>
