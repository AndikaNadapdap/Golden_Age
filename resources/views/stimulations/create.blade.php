<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stimulasi Baru - Golden Age</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #3B82F6;
            --secondary-color: #1E40AF;
        }
        body { background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; }
        .form-card { background: white; border-radius: 20px; box-shadow: 0 10px 40px rgba(59, 130, 246, 0.1); padding: 40px; margin: 40px auto; max-width: 900px; }
        .form-header { text-align: center; margin-bottom: 40px; }
        .form-header h2 { color: var(--primary-color); font-weight: 700; margin-bottom: 10px; }
        .form-header p { color: #64748b; }
        .form-label { font-weight: 600; color: #334155; margin-bottom: 8px; }
        .form-control, .form-select { border: 2px solid #e2e8f0; border-radius: 10px; padding: 12px; transition: all 0.3s; }
        .form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        .image-preview { margin-top: 15px; display: none; }
        .image-preview img { max-width: 100%; max-height: 300px; border-radius: 10px; border: 3px solid #e2e8f0; }
        .btn-primary { background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); border: none; padding: 14px 40px; border-radius: 10px; font-weight: 600; transition: all 0.3s; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3); }
        .btn-secondary { background: #94a3b8; border: none; padding: 14px 40px; border-radius: 10px; font-weight: 600; }
        .btn-secondary:hover { background: #64748b; }
        .invalid-feedback { font-size: 14px; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
                <i class="bi bi-hearts me-2"></i>Golden Age
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="form-card">
            <div class="form-header">
                <h2><i class="bi bi-puzzle me-2"></i>Tambah Stimulasi Baru</h2>
                <p>Isi form di bawah untuk menambahkan aktivitas stimulasi anak</p>
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

            <form action="{{ route('stimulations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Judul -->
                    <div class="col-md-12 mb-3">
                        <label for="title" class="form-label">Judul Aktivitas *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" 
                               placeholder="Contoh: Bermain Cilukba" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Kategori *</label>
                        <select class="form-select @error('category') is-invalid @enderror" 
                                id="category" name="category" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Motorik Kasar" {{ old('category') == 'Motorik Kasar' ? 'selected' : '' }}>Motorik Kasar</option>
                            <option value="Motorik Halus" {{ old('category') == 'Motorik Halus' ? 'selected' : '' }}>Motorik Halus</option>
                            <option value="Kognitif" {{ old('category') == 'Kognitif' ? 'selected' : '' }}>Kognitif</option>
                            <option value="Bahasa" {{ old('category') == 'Bahasa' ? 'selected' : '' }}>Bahasa</option>
                            <option value="Sosial-Emosional" {{ old('category') == 'Sosial-Emosional' ? 'selected' : '' }}>Sosial-Emosional</option>
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
                            <option value="0-3 bulan" {{ old('age_range') == '0-3 bulan' ? 'selected' : '' }}>0-3 bulan</option>
                            <option value="4-6 bulan" {{ old('age_range') == '4-6 bulan' ? 'selected' : '' }}>4-6 bulan</option>
                            <option value="7-9 bulan" {{ old('age_range') == '7-9 bulan' ? 'selected' : '' }}>7-9 bulan</option>
                            <option value="10-12 bulan" {{ old('age_range') == '10-12 bulan' ? 'selected' : '' }}>10-12 bulan</option>
                        </select>
                        @error('age_range')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Durasi -->
                    <div class="col-md-6 mb-3">
                        <label for="duration" class="form-label">Durasi (menit) *</label>
                        <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                               id="duration" name="duration" value="{{ old('duration') }}" 
                               placeholder="Contoh: 15" min="1" required>
                        @error('duration')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Deskripsi Singkat *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3" 
                                  placeholder="Jelaskan aktivitas ini secara singkat..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Bahan/Alat -->
                    <div class="col-md-12 mb-3">
                        <label for="materials" class="form-label">Bahan/Alat yang Diperlukan *</label>
                        <textarea class="form-control @error('materials') is-invalid @enderror" 
                                  id="materials" name="materials" rows="4" 
                                  placeholder="Contoh:&#10;- Mainan warna-warni&#10;- Kain lembut&#10;- Boneka kecil" required>{{ old('materials') }}</textarea>
                        @error('materials')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Langkah-langkah -->
                    <div class="col-md-12 mb-3">
                        <label for="instructions" class="form-label">Langkah-langkah *</label>
                        <textarea class="form-control @error('instructions') is-invalid @enderror" 
                                  id="instructions" name="instructions" rows="6" 
                                  placeholder="Contoh:&#10;1. Persiapkan mainan di depan bayi&#10;2. Tunjukkan mainan sambil bersuara&#10;3. Dorong bayi untuk meraih mainan&#10;4. Berikan pujian saat berhasil" required>{{ old('instructions') }}</textarea>
                        @error('instructions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Manfaat -->
                    <div class="col-md-12 mb-3">
                        <label for="benefits" class="form-label">Manfaat *</label>
                        <textarea class="form-control @error('benefits') is-invalid @enderror" 
                                  id="benefits" name="benefits" rows="4" 
                                  placeholder="Contoh:&#10;- Meningkatkan koordinasi mata dan tangan&#10;- Melatih kemampuan motorik halus&#10;- Menguatkan ikatan emosional" required>{{ old('benefits') }}</textarea>
                        @error('benefits')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div class="col-md-12 mb-3">
                        <label for="image" class="form-label">Gambar Aktivitas</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*" onchange="previewImage(event)">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="image-preview" id="imagePreview">
                            <img id="preview" src="" alt="Preview">
                        </div>
                    </div>

                    <!-- Video Tutorial -->
                    <div class="col-md-12 mb-3">
                        <label for="visio" class="form-label">Video Tutorial <span class="badge bg-info">Optional</span></label>
                        <input type="file" class="form-control @error('visio') is-invalid @enderror" 
                               id="visio" name="visio" accept="video/*">
                        <small class="text-muted d-block mt-1">Format: MP4, MOV, AVI, WEBM, max 50MB</small>
                        @error('visio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('stimulations.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>Simpan Stimulasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewDiv = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewDiv.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }

        function previewVideo(event) {
            const preview = document.getElementById('videoPreview');
            const info = document.getElementById('videoInfo');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    info.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                info.style.display = 'none';
            }
        }
    </script>
</body>
</html>
