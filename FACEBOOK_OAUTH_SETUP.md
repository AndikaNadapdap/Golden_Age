# Setup Facebook OAuth Login

## Langkah-langkah Konfigurasi Facebook Developer

### 1. Buat Aplikasi Facebook

1. Kunjungi **Facebook Developers Console**: https://developers.facebook.com/
2. Klik **"My Apps"** di kanan atas
3. Klik tombol **"Create App"**
4. Pilih **"Consumer"** sebagai tipe aplikasi
5. Isi detail aplikasi:
    - **App Display Name**: Golden Age - Panduan 1000 Hari
    - **App Contact Email**: Email Anda
6. Klik **"Create App"**

### 2. Tambahkan Facebook Login Product

1. Di dashboard aplikasi, scroll ke bagian **"Add Products to Your App"**
2. Cari **"Facebook Login"** dan klik **"Set Up"**
3. Pilih platform **"Web"**
4. Isi **Site URL**: `http://127.0.0.1:8000`
5. Klik **"Save"** dan **"Continue"**

### 3. Konfigurasi Facebook Login Settings

1. Di menu kiri, klik **"Facebook Login"** → **"Settings"**
2. Isi **Valid OAuth Redirect URIs** dengan:
    ```
    http://127.0.0.1:8000/auth/facebook/callback
    http://localhost:8000/auth/facebook/callback
    ```
3. Klik **"Save Changes"**

### 4. Dapatkan App ID dan App Secret

1. Di menu kiri, klik **"Settings"** → **"Basic"**
2. Anda akan melihat:
    - **App ID**: Salin nilai ini
    - **App Secret**: Klik **"Show"** untuk melihat, kemudian salin
3. **PENTING**: Simpan kedua nilai ini dengan aman

### 5. Konfigurasi App Domain

1. Masih di **Settings** → **"Basic"**
2. Tambahkan di **App Domains**:
    ```
    127.0.0.1
    localhost
    ```
3. Klik **"Save Changes"**

### 6. Update File .env

Buka file `.env` di project Laravel Anda dan update:

```env
FACEBOOK_CLIENT_ID=your-facebook-app-id
FACEBOOK_CLIENT_SECRET=your-facebook-app-secret
FACEBOOK_REDIRECT_URI=http://127.0.0.1:8000/auth/facebook/callback
```

Ganti `your-facebook-app-id` dan `your-facebook-app-secret` dengan nilai yang Anda dapatkan dari Facebook Developer Console.

### 7. Set App Mode ke Development (untuk testing)

1. Di dashboard aplikasi, lihat bagian atas
2. Mode default adalah **"Development"**
3. Untuk production, Anda perlu mengubah ke **"Live Mode"** setelah menyelesaikan App Review dari Facebook

### 8. Jalankan Aplikasi

```bash
php artisan config:clear
php artisan cache:clear
php artisan serve
```

### 9. Test Login

1. Buka browser dan akses: http://127.0.0.1:8000/login
2. Klik tombol **"Masuk dengan Facebook"**
3. Login dengan akun Facebook Anda
4. Berikan izin yang diminta
5. Anda akan diarahkan kembali ke aplikasi dan otomatis login

## Troubleshooting

### Error: "App Not Setup"

-   Pastikan Facebook Login sudah diaktifkan di dashboard
-   Periksa Valid OAuth Redirect URIs sudah benar

### Error: "Can't Load URL"

-   Pastikan App Domain sudah diisi dengan `127.0.0.1` dan `localhost`
-   Periksa Site URL di settings

### Error: "Invalid App ID"

-   Pastikan FACEBOOK_CLIENT_ID di .env sesuai dengan App ID di Facebook Developer Console
-   Jalankan `php artisan config:clear`

### Login hanya bisa dengan akun developer

-   Ini normal untuk mode Development
-   Tambahkan tester di **Roles** → **"Test Users"** atau **"Testers"**
-   Untuk public access, submit untuk App Review dan ubah ke Live Mode

## Fitur yang Sudah Diimplementasikan

✅ Web Login dengan Facebook
✅ API Login dengan Facebook (untuk mobile apps)
✅ Auto-register user baru dengan role "orangtua"
✅ Link Facebook account ke existing account (jika email sama)
✅ Remember login
✅ JWT Token untuk API authentication

## Endpoint yang Tersedia

### Web Routes

-   GET `/auth/facebook` - Redirect ke halaman login Facebook
-   GET `/auth/facebook/callback` - Handle callback dari Facebook

### API Routes

-   GET `/api/auth/facebook/redirect` - Get redirect URL untuk mobile apps
-   GET `/api/auth/facebook/callback` - Handle callback dan return JWT token

## Keamanan

-   Facebook ID disimpan terenkripsi di database
-   Password random di-generate untuk user yang register via Facebook
-   Email unique constraint mencegah duplikasi akun
-   Status user default: 'aktif'
-   Role default: 'orangtua'

## Catatan Penting

1. **Development Mode**: Hanya developer dan tester yang bisa login
2. **Production Mode**: Perlu App Review dari Facebook untuk public access
3. **HTTPS Required**: Untuk production, gunakan HTTPS
4. **Privacy Policy**: Facebook mewajibkan privacy policy untuk app yang live
5. **Data Deletion**: Facebook mewajibkan endpoint untuk data deletion request

## Resources

-   Facebook Login Documentation: https://developers.facebook.com/docs/facebook-login
-   Laravel Socialite: https://laravel.com/docs/socialite
-   Facebook App Review: https://developers.facebook.com/docs/app-review
