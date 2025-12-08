<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Milestone - Golden Age</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #10B981;
            --secondary-color: #059669;
        }
        body { background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; }
        .form-card { background: white; border-radius: 20px; box-shadow: 0 10px 40px rgba(16, 185, 129, 0.1); padding: 40px; margin: 40px auto; max-width: 800px; }
        .form-header { text-align: center; margin-bottom: 40px; }
        .form-header h2 { color: var(--primary-color); font-weight: 700; margin-bottom: 10px; }
        .form-header p { color: #64748b; }
        .form-label { font-weight: 600; color: #334155; margin-bottom: 8px; }
        .form-control, .form-select { border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px; transition: all 0.3s; }
        .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1); }
        .btn-primary { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); border: none; padding: 14px 40px; border-radius: 10px; font-weight: 600; transition: all 0.3s; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3); }
        .btn-secondary { background: #94a3b8; border: none; padding: 14px 40px; border-radius: 10px; font-weight: 600; }
        .btn-secondary:hover { background: #64748b; }
        .btn-danger { background: #EF4444; border: none; padding: 14px 40px; border-radius: 10px; font-weight: 600; }
        .btn-danger:hover { background: #DC2626; }
        .invalid-feedback { font-size: 14px; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="{{ route('home') }}">
                <i class="bi bi-hearts me-2"></i>Golden Age
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="form-card">
            <div class="form-header">
                <h2><i class="bi bi-pencil-square me-2"></i>Edit Milestone</h2>
                <p>Perbarui informasi milestone perkembangan</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('milestones.update', $milestone->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Nama Milestone -->
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Nama Milestone *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $milestone->name) }}" 
                               placeholder="Contoh: Mengangkat kepala saat tengkurap" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Kategori *</label>
                        <select class="form-select @error('category') is-invalid @enderror" 
                                id="category" name="category" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Motorik Kasar" {{ old('category', $milestone->category) == 'Motorik Kasar' ? 'selected' : '' }}>Motorik Kasar</option>
                            <option value="Motorik Halus" {{ old('category', $milestone->category) == 'Motorik Halus' ? 'selected' : '' }}>Motorik Halus</option>
                            <option value="Kognitif" {{ old('category', $milestone->category) == 'Kognitif' ? 'selected' : '' }}>Kognitif</option>
                            <option value="Bahasa" {{ old('category', $milestone->category) == 'Bahasa' ? 'selected' : '' }}>Bahasa</option>
                            <option value="Sosial-Emosional" {{ old('category', $milestone->category) == 'Sosial-Emosional' ? 'selected' : '' }}>Sosial-Emosional</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Rentang Usia -->
                    <div class="col-md-6 mb-3">
                        <label for="age_range" class="form-label">Rentang Usia *</label>
                        <select class="form-select @error('age_range') is-invalid @enderror" 
                                id="age_range" name="age_range" required>
                            <option value="">Pilih Rentang Usia</option>
                            <option value="0-3 bulan" {{ old('age_range', $milestone->age_range) == '0-3 bulan' ? 'selected' : '' }}>0-3 bulan</option>
                            <option value="4-6 bulan" {{ old('age_range', $milestone->age_range) == '4-6 bulan' ? 'selected' : '' }}>4-6 bulan</option>
                            <option value="7-9 bulan" {{ old('age_range', $milestone->age_range) == '7-9 bulan' ? 'selected' : '' }}>7-9 bulan</option>
                            <option value="10-12 bulan" {{ old('age_range', $milestone->age_range) == '10-12 bulan' ? 'selected' : '' }}>10-12 bulan</option>
                        </select>
                        @error('age_range')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Deskripsi *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" 
                                  placeholder="Jelaskan milestone ini secara detail..." required>{{ old('description', $milestone->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
<<<<<<< HEAD
                    </div>
=======
                    </div> 
>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9

                    <!-- Tips -->
                    <div class="col-md-12 mb-3">
                        <label for="tips" class="form-label">Tips untuk Orang Tua (Opsional)</label>
                        <textarea class="form-control @error('tips') is-invalid @enderror" 
                                  id="tips" name="tips" rows="3" 
                                  placeholder="Berikan tips bagaimana orang tua bisa membantu anak mencapai milestone ini...">{{ old('tips', $milestone->tips) }}</textarea>
                        @error('tips')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <div>
                        <a href="{{ route('milestones.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Batal
                        </a>
                        <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi bi-trash me-2"></i>Hapus
                        </button>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>Update Milestone
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus milestone <strong>"{{ $milestone->name }}"</strong>? 
                    Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('milestones.destroy', $milestone->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
