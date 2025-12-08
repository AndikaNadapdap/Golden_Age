<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep MPASI - Paduan 1000 Hari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        :root { --primary-color: #F59E0B; --secondary-color: #5CE1E6; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 1rem 0; }
        .logo { width: 45px; height: 45px; background: var(--secondary-color); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .logo i { color: white; font-size: 24px; }
        .form-container { background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.06); margin-top: 2rem; }
        .form-label { font-weight: 600; color: #1e293b; }
        .btn-primary { background: var(--primary-color); border: none; }
        .btn-primary:hover { background: #D97706; }
        .image-preview { max-width: 300px; margin-top: 1rem; border-radius: 8px; display: none; }
        .current-image { max-width: 300px; margin-top: 1rem; border-radius: 8px; }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <div class="logo"><i class="bi bi-heart-fill"></i></div>
                <span class="fw-bold">Paduan 1000 Hari</span>
            </a>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0"><i class="bi bi-pencil me-2" style="color: var(--primary-color);"></i>Edit Resep MPASI</h2>
                        <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Nama Resep <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $recipe->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="age_range" class="form-label">Rentang Usia <span class="text-danger">*</span></label>
                                <select class="form-select @error('age_range') is-invalid @enderror" 
                                        id="age_range" name="age_range" required>
                                    <option value="">Pilih Rentang Usia</option>
                                    <option value="6-8 bulan" {{ old('age_range', $recipe->age_range) == '6-8 bulan' ? 'selected' : '' }}>6-8 bulan</option>
                                    <option value="9-11 bulan" {{ old('age_range', $recipe->age_range) == '9-11 bulan' ? 'selected' : '' }}>9-11 bulan</option>
                                    <option value="12-24 bulan" {{ old('age_range', $recipe->age_range) == '12-24 bulan' ? 'selected' : '' }}>12-24 bulan</option>
                                </select>
                                @error('age_range')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select @error('category') is-invalid @enderror" 
                                        id="category" name="category" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Bubur" {{ old('category', $recipe->category) == 'Bubur' ? 'selected' : '' }}>Bubur</option>
                                    <option value="Puree" {{ old('category', $recipe->category) == 'Puree' ? 'selected' : '' }}>Puree</option>
                                    <option value="Finger Food" {{ old('category', $recipe->category) == 'Finger Food' ? 'selected' : '' }}>Finger Food</option>
                                    <option value="Sup" {{ old('category', $recipe->category) == 'Sup' ? 'selected' : '' }}>Sup</option>
                                    <option value="Camilan" {{ old('category', $recipe->category) == 'Camilan' ? 'selected' : '' }}>Camilan</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="cooking_time" class="form-label">Waktu Memasak (menit)</label>
                                <input type="number" class="form-control @error('cooking_time') is-invalid @enderror" 
                                       id="cooking_time" name="cooking_time" value="{{ old('cooking_time', $recipe->cooking_time) }}">
                                @error('cooking_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="servings" class="form-label">Porsi <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('servings') is-invalid @enderror" 
                                       id="servings" name="servings" value="{{ old('servings', $recipe->servings) }}" required>
                                @error('servings')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="difficulty" class="form-label">Tingkat Kesulitan <span class="text-danger">*</span></label>
                                <select class="form-select @error('difficulty') is-invalid @enderror" 
                                        id="difficulty" name="difficulty" required>
                                    <option value="Mudah" {{ old('difficulty', $recipe->difficulty) == 'Mudah' ? 'selected' : '' }}>Mudah</option>
                                    <option value="Sedang" {{ old('difficulty', $recipe->difficulty) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                    <option value="Sulit" {{ old('difficulty', $recipe->difficulty) == 'Sulit' ? 'selected' : '' }}>Sulit</option>
                                </select>
                                @error('difficulty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $recipe->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ingredients" class="form-label">Bahan-bahan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('ingredients') is-invalid @enderror" 
                                      id="ingredients" name="ingredients" rows="6" 
                                      placeholder="Pisahkan setiap bahan dengan enter" required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
                            <small class="text-muted">Tuliskan setiap bahan dalam baris baru</small>
                            @error('ingredients')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="instructions" class="form-label">Cara Membuat <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('instructions') is-invalid @enderror" 
                                      id="instructions" name="instructions" rows="8" 
                                      placeholder="Tuliskan langkah-langkah memasak" required>{{ old('instructions', $recipe->instructions) }}</textarea>
                            <small class="text-muted">Tuliskan langkah-langkah dengan jelas</small>
                            @error('instructions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Resep</label>
                            @if($recipe->image)
                                <div class="mb-2">
                                    <p class="text-muted mb-1">Gambar saat ini:</p>
                                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="Current image" class="current-image" id="currentImage">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*" onchange="previewImage(event)">
                            <small class="text-muted">Upload gambar baru untuk mengganti gambar lama. Format: JPG, PNG, max 2MB</small>
                            <img id="imagePreview" class="image-preview" alt="Preview">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Update Resep
                            </button>
                            <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="button" class="btn btn-danger ms-auto" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bi bi-trash me-2"></i>Hapus Resep
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus resep "<strong>{{ $recipe->title }}</strong>"?
                    Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            const currentImage = document.getElementById('currentImage');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    if (currentImage) {
                        currentImage.style.display = 'none';
                    }
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
</body>
</html>
