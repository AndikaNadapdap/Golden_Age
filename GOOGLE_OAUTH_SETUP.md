# Setup Google OAuth Login

## 1. Buat Google Cloud Project

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih project yang sudah ada
3. Enable **Google+ API**

## 2. Buat OAuth 2.0 Credentials

1. Pergi ke **APIs & Services** > **Credentials**
2. Klik **Create Credentials** > **OAuth client ID**
3. Pilih **Web application**
4. Isi konfigurasi:
    - **Name**: Golden Age OAuth
    - **Authorized JavaScript origins**:
        - `http://127.0.0.1:8000`
        - `http://localhost:8000`
    - **Authorized redirect URIs**:
        - `http://127.0.0.1:8000/auth/google/callback`
        - `http://localhost:8000/auth/google/callback`
5. Klik **Create**
6. Salin **Client ID** dan **Client Secret**

## 3. Konfigurasi .env

Update file `.env` dengan credentials yang didapat:

```env
GOOGLE_CLIENT_ID=your-google-client-id.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

## 4. Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
```

## 5. Testing

### Web Login:

1. Buka halaman login: `http://127.0.0.1:8000/login`
2. Klik tombol **"Masuk dengan Google"**
3. Pilih akun Google
4. User otomatis login dengan role **parent**

### API Testing:

**1. Get Google OAuth URL:**

```bash
GET /api/auth/google/redirect
```

Response:

```json
{
    "success": true,
    "url": "https://accounts.google.com/o/oauth2/auth?..."
}
```

**2. Handle Callback (setelah user authorize):**

```bash
GET /api/auth/google/callback?code=xxx&scope=xxx
```

Response:

```json
{
    "success": true,
    "message": "Login berhasil",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@gmail.com",
        "role": "parent"
    }
}
```

## Features

✅ Login dengan Google untuk orang tua (parent)
✅ Auto-create user baru jika belum terdaftar
✅ Link Google ID dengan existing user berdasarkan email
✅ Default role: **parent** untuk semua Google login
✅ Support Web dan API
✅ Secure dengan random password untuk user Google

## Routes

### Web Routes:

-   `GET /auth/google` - Redirect ke Google OAuth
-   `GET /auth/google/callback` - Handle callback dari Google

### API Routes:

-   `GET /api/auth/google/redirect` - Get OAuth URL
-   `GET /api/auth/google/callback` - Handle callback dan return user data

## Security Notes

-   User yang login via Google mendapat random password yang secure
-   Google ID disimpan untuk mencegah duplikasi
-   Hanya email yang sudah terverifikasi oleh Google yang diterima
-   Default role selalu **parent** untuk keamanan
