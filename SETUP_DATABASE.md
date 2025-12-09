# 📦 Setup Database & Storage - Panduan 1000 Hari

Panduan lengkap setup database dan file storage setelah pull/clone repository.

## 🚀 Quick Start

### 1. Copy Environment File

```bash
cp .env.example .env
```

Atau di Windows PowerShell:
```powershell
Copy-Item .env.example .env
```

### 2. Update Database Configuration

Edit file `.env`:

```env
APP_NAME="Panduan 1000 Hari"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ppw_1000_hari
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120

FACEBOOK_CLIENT_ID=your_facebook_app_id
FACEBOOK_CLIENT_SECRET=your_facebook_app_secret
FACEBOOK_REDIRECT_URI=http://localhost:8000/auth/facebook/callback

GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### 3. Install Dependencies

```bash
composer install
npm install
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Create Database

**Option A - Via phpMyAdmin:**
1. Buka `http://localhost/phpmyadmin`
2. Klik tab "Databases"
3. Database name: `ppw_1000_hari`
4. Collation: `utf8mb4_unicode_ci`
5. Klik "Create"

**Option B - Via MySQL Command:**
```sql
CREATE DATABASE ppw_1000_hari CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**Option C - Via Terminal:**
```bash
mysql -u root -p -e "CREATE DATABASE ppw_1000_hari CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 6. Run Migrations

```bash
php artisan migrate
```

Ini akan membuat semua table:
- users
- articles
- recipes
- children
- milestones
- discussions
- sessions
- personal_access_tokens
- dll.

### 7. **Create Storage Symbolic Link (PENTING!)**

```bash
php artisan storage:link
```

**Ini WAJIB untuk upload gambar!** Tanpa ini, gambar yang di-upload tidak akan muncul.

Perintah ini membuat symbolic link dari `storage/app/public` ke `public/storage`.

### 8. Seed Database (Optional - Data Sample)

```bash
php artisan db:seed
```

Atau seed specific seeder:
```bash
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=DoctorSeeder
```

### 9. Build Assets

```bash
npm run dev
```

Atau untuk production:
```bash
npm run build
```

### 10. Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### 11. Set Folder Permissions (Linux/Mac)

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 12. Start Server

```bash
php artisan serve
```

Akses: `http://localhost:8000`

---

## 👤 Default Login Credentials

### Admin
- Email: `admin@goldenage.com`
- Password: `admin123`

### Doctor (if seeded)
- Email: `dr.budi@goldenage.com`
- Password: `doctor123`

---

## 📁 Struktur Storage

Setelah setup, struktur folder akan seperti ini:

```
Golden_Age/
├── public/
│   └── storage/  ← Symbolic link ke storage/app/public
│
└── storage/
    └── app/
        └── public/
            ├── articles/     ← Upload artikel
            ├── recipes/      ← Upload resep
            └── stimulations/ ← Upload stimulasi
```

---

## 🔧 Troubleshooting

### Error: "Access denied for user 'root'@'localhost'"
**Solusi:** Update password di `.env`:
```env
DB_PASSWORD=your_mysql_password
```

### Error: "Base table or view not found"
**Solusi:** Run migrations:
```bash
php artisan migrate
```

### Error: "419 PAGE EXPIRED"
**Solusi:** Clear cache dan pastikan sessions table ada:
```bash
php artisan config:clear
php artisan cache:clear
php artisan migrate
```

### Error: "Class 'Socialite' not found"
**Solusi:** Install dependencies:
```bash
composer install
```

### **Gambar Upload Tidak Muncul**

**Penyebab:**
- Symbolic link storage belum dibuat
- Permission folder salah
- Path gambar salah di blade

**Solusi:**

1. **Create symbolic link:**
```bash
php artisan storage:link
```

2. **Verify symbolic link exists:**
```bash
# Windows PowerShell
Test-Path "public\storage"

# Linux/Mac
ls -la public/storage
```

3. **Check uploaded files:**
```bash
# Windows
dir storage\app\public\articles

# Linux/Mac
ls -la storage/app/public/articles
```

4. **Fix permissions (Linux/Mac):**
```bash
chmod -R 775 storage
chown -R www-data:www-data storage
```

5. **Test upload:**
- Login sebagai admin
- Upload artikel dengan gambar
- Cek apakah file ada di `storage/app/public/articles/`
- Akses: `http://localhost:8000/storage/articles/namafile.jpg`

### Error: "The stream or file could not be opened"
**Solusi:** Fix permissions:
```bash
# Linux/Mac
chmod -R 775 storage bootstrap/cache

# Windows (run as Administrator)
icacls storage /grant Users:F /T
icacls bootstrap\cache /grant Users:F /T
```

### Error: "Symlink target already exists"
**Solusi:** Hapus symbolic link lama dan buat baru:
```bash
# Windows
rmdir public\storage
php artisan storage:link

# Linux/Mac
rm public/storage
php artisan storage:link
```

---

## 📊 Verify Setup

### 1. Cek Database

```bash
php artisan migrate:status
```

Expected output: All migrations should show "Ran"

### 2. Cek Storage Link

```bash
# Windows
Test-Path "public\storage"

# Linux/Mac  
ls -la public/ | grep storage
```

Expected: Should return `True` or show symlink arrow `storage -> ../storage/app/public`

### 3. Cek Permissions

```bash
# Windows - Not needed

# Linux/Mac
ls -la | grep storage
```

Expected: `drwxrwxr-x` or similar (775 permissions)

### 4. Test Upload

1. Login as admin: `http://localhost:8000/login`
2. Navigate to Articles: `http://localhost:8000/articles`
3. Click "Tambah Artikel Baru"
4. Upload gambar
5. Save
6. Check if image displays

---

## 📝 Post-Setup Checklist

- [ ] `.env` file configured
- [ ] Database `ppw_1000_hari` created
- [ ] Migrations run successfully
- [ ] **Storage symbolic link created** ⭐
- [ ] Composer dependencies installed
- [ ] NPM dependencies installed
- [ ] Application key generated
- [ ] Cache cleared
- [ ] Admin account seeded
- [ ] Can login as admin
- [ ] **Can upload and see images** ⭐

---

## 🎯 Quick Commands Reference

```bash
# Full setup from scratch
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link  # IMPORTANT!
php artisan db:seed
npm install && npm run dev

# Clear everything
php artisan config:clear
php artisan cache:clear  
php artisan route:clear
php artisan view:clear

# Start server
php artisan serve
```

---

## 📞 Need Help?

### Check Logs
```bash
# Latest errors
tail -f storage/logs/laravel.log

# Windows
Get-Content storage/logs/laravel.log -Tail 50 -Wait
```

### Debug Upload

Add to `ArticleController.php` temporarily:
```php
if ($request->hasFile('image')) {
    $image = $request->file('image');
    \Log::info('Image Upload Debug', [
        'original_name' => $image->getClientOriginalName(),
        'size' => $image->getSize(),
        'mime' => $image->getMimeType(),
        'path' => $image->getRealPath()
    ]);
    
    $imagePath = $image->store('articles', 'public');
    
    \Log::info('Image Stored', [
        'path' => $imagePath,
        'full_path' => storage_path('app/public/' . $imagePath),
        'exists' => \Storage::disk('public')->exists($imagePath)
    ]);
}
```

Then check `storage/logs/laravel.log` after upload.

---

## ⚠️ Common Mistakes

1. ❌ Forgot to run `php artisan storage:link`
2. ❌ Wrong `.env` database credentials
3. ❌ Forgot to run `php artisan migrate`
4. ❌ Wrong file permissions on Linux/Mac
5. ❌ Not installing composer dependencies
6. ❌ Cache not cleared after changes

---

## 📚 Additional Resources

- [Laravel File Storage Documentation](https://laravel.com/docs/filesystem)
- [Laravel Migrations Documentation](https://laravel.com/docs/migrations)
- [Laravel Seeding Documentation](https://laravel.com/docs/seeding)

---

**Created:** December 9, 2025  
**Last Updated:** December 9, 2025
