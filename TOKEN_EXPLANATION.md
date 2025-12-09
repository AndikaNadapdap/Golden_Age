# Penjelasan Token dalam API

## Apa itu Token?

**Token** dalam konteks API adalah sebuah string unik yang berfungsi sebagai "kunci akses" atau "tanda pengenal" untuk mengidentifikasi dan mengautentikasi pengguna tanpa harus mengirim username dan password setiap kali melakukan request.

## Analogi Sederhana

Bayangkan token seperti **kartu identitas hotel**:

-   Saat check-in (login), Anda diberi kartu identitas
-   Kartu ini membuktikan Anda tamu yang sah
-   Anda gunakan kartu ini untuk masuk kamar, lift, atau fasilitas lain
-   Tidak perlu tunjukkan paspor dan isi formulir lagi setiap kali
-   Saat check-out (logout), kartu tidak berlaku lagi

## Bagaimana Token Bekerja di API Anda?

### 1. **Login dengan Facebook/Google**

```
User → Klik "Login dengan Facebook"
     → Redirect ke Facebook
     → User approve
     → Callback ke server Anda
     → Server create/update user
     → Server generate TOKEN
     → Return token ke aplikasi
```

### 2. **Token yang Dihasilkan**

Contoh token dari Laravel Sanctum:

```
1|AbCdEfGhIjKlMnOpQrStUvWxYz1234567890
```

Struktur:

-   `1` = ID token di database
-   `|` = Separator
-   `AbCdEfGh...` = String acak terenkripsi

### 3. **Menggunakan Token**

Setelah mendapat token, setiap request API harus menyertakan token di header:

```http
GET /api/user
Authorization: Bearer 1|AbCdEfGhIjKlMnOpQrStUvWxYz1234567890
```

### 4. **Verifikasi Token**

```
Request dengan token → Server cek token di database
                    → Token valid? → Lanjutkan request
                    → Token invalid? → Return error 401 Unauthorized
```

## Keuntungan Menggunakan Token

✅ **Keamanan**: Password tidak dikirim berulang kali  
✅ **Stateless**: Server tidak perlu menyimpan session  
✅ **Portable**: Bisa digunakan di berbagai platform (mobile, web, desktop)  
✅ **Flexible**: Bisa set expiry time dan revoke kapan saja  
✅ **Performance**: Lebih cepat daripada session-based authentication

## Perbedaan Web Login vs API Login

### **Web Login (Session-Based)**

```
Browser → Login → Server create session → Session ID stored in cookie
        → Browser auto-send cookie setiap request
        → Server validate session
```

Karakteristik:

-   Session disimpan di server
-   Cookie auto-attach oleh browser
-   Terikat dengan domain
-   Cocok untuk aplikasi web tradisional

### **API Login (Token-Based)**

```
App → Login → Server create token → App store token (localStorage/memory)
    → App manually send token di header setiap request
    → Server validate token
```

Karakteristik:

-   Token disimpan di client
-   Token harus dikirim manual di header
-   Cross-domain friendly
-   Cocok untuk mobile app, SPA, microservices

## Laravel Sanctum

Laravel Sanctum adalah package yang Anda gunakan untuk token management. Fitur:

### 1. **Personal Access Tokens**

Token yang dibuat untuk user tertentu:

```php
$token = $user->createToken('token-name');
return $token->plainTextToken; // "1|AbCdEfGh..."
```

### 2. **Token Abilities (Permissions)**

Token bisa punya permission:

```php
$token = $user->createToken('token-name', ['post:create', 'post:update']);

// Di middleware:
if ($request->user()->tokenCan('post:create')) {
    // Allowed
}
```

### 3. **Revoke Token**

```php
// Hapus token tertentu
$user->tokens()->where('id', $tokenId)->delete();

// Hapus semua token user
$user->tokens()->delete();
```

### 4. **Token Expiry**

Set di `config/sanctum.php`:

```php
'expiration' => 60 * 24, // 24 jam
```

## Implementasi di Aplikasi Anda

### **API Routes** (`routes/api.php`)

```php
Route::prefix('auth/facebook')->group(function () {
    Route::get('/login-url', [FacebookAuthController::class, 'getLoginUrl']);
    Route::get('/callback', [FacebookAuthController::class, 'handleCallback']);
    Route::post('/login-token', [FacebookAuthController::class, 'loginWithToken']);
    Route::post('/verify-token', [FacebookAuthController::class, 'verifyToken']);
    Route::post('/logout', [FacebookAuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/me', [FacebookAuthController::class, 'me'])->middleware('auth:sanctum');
});
```

### **Flow Penggunaan API**

#### **Step 1: Get Login URL**

```http
GET /api/auth/facebook/login-url
```

Response:

```json
{
    "login_url": "https://www.facebook.com/v18.0/dialog/oauth?client_id=..."
}
```

#### **Step 2: User Login di Facebook**

User klik URL → Login di Facebook → Approve

#### **Step 3: Callback & Get Token**

```http
GET /api/auth/facebook/callback?code=ABC123
```

Response:

```json
{
    "success": true,
    "message": "Login berhasil",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    },
    "token": "1|AbCdEfGhIjKlMnOpQrStUvWxYz1234567890"
}
```

#### **Step 4: Use Token untuk Request**

```http
GET /api/auth/facebook/me
Authorization: Bearer 1|AbCdEfGhIjKlMnOpQrStUvWxYz1234567890
```

Response:

```json
{
    "success": true,
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "role": "parent"
    }
}
```

#### **Step 5: Logout (Revoke Token)**

```http
POST /api/auth/facebook/logout
Authorization: Bearer 1|AbCdEfGhIjKlMnOpQrStUvWxYz1234567890
```

Response:

```json
{
    "success": true,
    "message": "Logout berhasil"
}
```

## Keamanan Token

### **Praktik Terbaik:**

1. **HTTPS Only**: Selalu gunakan HTTPS di production
2. **Short Expiry**: Set token expiry yang wajar (24 jam - 7 hari)
3. **Secure Storage**:
    - Mobile: Secure Storage (Keychain/Keystore)
    - Web: httpOnly cookie atau localStorage (jika tidak ada XSS risk)
4. **Refresh Mechanism**: Implement refresh token untuk UX lebih baik
5. **Rate Limiting**: Batasi jumlah request per token
6. **Token Rotation**: Rotate token secara berkala

### **Jangan:**

❌ Simpan token di URL query parameter  
❌ Simpan token di localStorage jika ada XSS vulnerability  
❌ Gunakan token yang tidak expire  
❌ Share token antar user  
❌ Hardcode token di code

## Troubleshooting

### **Token Invalid/Unauthorized**

```
Error: Unauthenticated
```

**Penyebab:**

-   Token tidak dikirim di header
-   Token sudah expired
-   Token sudah di-revoke
-   Format header salah

**Solusi:**

```http
Authorization: Bearer {token}  ✅
Authorization: {token}         ❌
Bearer {token}                 ❌
```

### **Token Not Working**

**Checklist:**

1. ✅ API routes sudah di-enable di `bootstrap/app.php`?
2. ✅ `SANCTUM_STATEFUL_DOMAINS` sudah di-set di `.env`?
3. ✅ Token dikirim dengan format `Bearer {token}`?
4. ✅ Middleware `auth:sanctum` sudah ditambahkan?
5. ✅ Cache sudah di-clear?

## Kapan Pakai Web Login vs API Login?

### **Gunakan Web Login (Session):**

-   Aplikasi web monolith tradisional
-   SEO penting (server-side rendering)
-   User tidak logout dari browser
-   Same-origin requests only

### **Gunakan API Login (Token):**

-   Mobile aplikasi (iOS, Android)
-   Single Page Application (React, Vue, Angular)
-   Microservices architecture
-   Cross-domain requests
-   Multiple client platforms (web + mobile)

## Kesimpulan

Token adalah mekanisme modern untuk autentikasi API yang:

-   Lebih aman untuk aplikasi distributed
-   Cocok untuk arsitektur modern (SPA, mobile)
-   Scalable dan stateless
-   Mudah di-manage dengan Laravel Sanctum

Aplikasi Anda sekarang mendukung **BOTH**:

1. **Web Login** → Session-based (untuk browser)
2. **API Login** → Token-based (untuk mobile/SPA)

Pilih sesuai kebutuhan client yang mengakses aplikasi Anda! 🚀
