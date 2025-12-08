<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel - Paduan 1000 Hari</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #EC4899;
            --secondary-color: #5CE1E6;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .logo {
            width: 40px;
            height: 40px;
            background: var(--secondary-color);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .admin-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .image-preview {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 12px;
            margin-top: 16px;
            display: none;
        }

        .image-preview.show {
            display: block;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 12px 32px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #db2777;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('welcome') }}">
                <div class="logo">
                    <i class="bi bi-heart-fill text-white"></i>
                </div>
                <span class="fw-bold">Paduan 1000 Hari</span>
            </a>
            <div class="ms-auto">
                <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </nav>

    <div class="admin-container">
        <div class="form-card">
            <h2 class="mb-4">
                <i class="bi bi-plus-circle me-2"></i>Tambah Artikel Baru
            </h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="form-label fw-semibold">
                        <i class="bi bi-type me-2"></i>Judul Artikel
                    </label>
                    <input type="text" 
                           class="form-control form-control-lg" 
                           id="title" 
                           name="title" 
                           placeholder="Masukkan judul artikel..."
                           value="{{ old('title') }}" 
                           required>
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label for="category" class="form-label fw-semibold">
                        <i class="bi bi-tag me-2"></i>Kategori
                    </label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="">Pilih Kategori</option>
                        <option value="1000 HPK" {{ old('category') == '1000 HPK' ? 'selected' : '' }}>1000 HPK</option>
                        <option value="Nutrisi" {{ old('category') == 'Nutrisi' ? 'selected' : '' }}>Nutrisi</option>
                        <option value="Perkembangan" {{ old('category') == 'Perkembangan' ? 'selected' : '' }}>Perkembangan</option>
                        <option value="Kesehatan" {{ old('category') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                    </select>
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <label for="image" class="form-label fw-semibold">
                        <i class="bi bi-image me-2"></i>Gambar Artikel (Opsional)
                    </label>
                    <input type="file" 
                           class="form-control" 
                           id="image" 
                           name="image" 
                           accept="image/jpeg,image/png,image/jpg"
                           onchange="previewImage(this)">
                    <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB</small>
                    
                    <!-- Image Preview -->
                    <img id="imagePreview" class="image-preview" src="" alt="Preview">
                </div>

                <!-- Excerpt -->
                <div class="mb-4">
                    <label for="excerpt" class="form-label fw-semibold">
                        <i class="bi bi-text-paragraph me-2"></i>Ringkasan (Opsional)
                    </label>
                    <textarea class="form-control" 
                              id="excerpt" 
                              name="excerpt" 
                              rows="3" 
                              placeholder="Ringkasan singkat artikel (akan auto-generate jika kosong)">{{ old('excerpt') }}</textarea>
                </div>

                <!-- Content -->
                <div class="mb-4">
                    <label for="content" class="form-label fw-semibold">
                        <i class="bi bi-file-text me-2"></i>Konten Artikel
                    </label>
                    <textarea class="form-control" 
                              id="content" 
                              name="content" 
                              rows="15" 
                              placeholder="Tulis konten artikel di sini..." 
                              required>{{ old('content') }}</textarea>
                    <small class="text-muted">Gunakan Enter untuk paragraf baru</small>
                </div>

                <!-- References -->
                <div class="mb-4">
                    <label for="references" class="form-label fw-semibold">
                        <i class="bi bi-book me-2"></i>Referensi Artikel (Opsional)
                    </label>
                    <textarea class="form-control" 
                              id="references" 
                              name="references" 
                              rows="4" 
                              placeholder="Masukkan referensi artikel...&#10;Contoh:&#10;1. Ikatan Dokter Anak Indonesia, UKK Nutrisi dan Penyakit Metabolik&#10;2. WHO. Infant and Young Child Feeding Model Chapter">{{ old('references') }}</textarea>
                    <small class="text-muted">Tuliskan sumber referensi artikel. Pisahkan dengan enter untuk setiap referensi.</small>
                </div>

                <!-- Publish Status -->
                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" 
                               type="checkbox" 
                               id="is_published" 
                               name="is_published" 
                               value="1"
                               {{ old('is_published') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">
                            <i class="bi bi-check-circle me-2"></i>Publikasikan artikel sekarang
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Simpan Artikel
                    </button>
                    <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.add('show');
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.classList.remove('show');
            }
        }
    </script>
</body>
</html>
