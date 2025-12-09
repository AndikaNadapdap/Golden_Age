<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class FacebookAuthController extends Controller
{
    /**
     * Redirect to Facebook OAuth
     */
    public function redirectToFacebook()
    {
        try {
            Log::info('=== FACEBOOK WEB LOGIN START ===', [
                'session_id' => session()->getId(),
                'url' => request()->url()
            ]);
            
            return Socialite::driver('facebook')
                ->scopes(['email', 'public_profile'])
                ->redirect();
                
        } catch (Exception $e) {
            Log::error('Facebook Web OAuth: Redirect Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('login')
                ->with('error', 'Gagal menghubungkan ke Facebook: ' . $e->getMessage());
        }
    }

    /**
     * Handle Facebook OAuth Callback
     */
    public function handleFacebookCallback(Request $request)
    {
        try {
            Log::info('=== FACEBOOK WEB CALLBACK RECEIVED ===');
            Log::info('Callback Request Details', [
                'full_url' => $request->fullUrl(),
                'method' => $request->method(),
                'has_code' => $request->has('code'),
                'has_error' => $request->has('error'),
                'session_id' => session()->getId(),
                'all_params' => $request->all()
            ]);
            
            // Check for error from Facebook
            if ($request->has('error')) {
                Log::warning('Facebook Web OAuth: Error from Facebook', [
                    'error' => $request->input('error'),
                    'error_reason' => $request->input('error_reason'),
                    'error_description' => $request->input('error_description')
                ]);
                
                return redirect()->route('login')
                    ->with('error', 'Login Facebook dibatalkan.');
            }

            // Check if code exists
            if (!$request->has('code')) {
                Log::error('Facebook Web OAuth: No authorization code');
                return redirect()->route('login')
                    ->with('error', 'Kode otorisasi tidak ditemukan.');
            }

            Log::info('Facebook Web OAuth: Getting user from Facebook');

            // Get user from Facebook (WITHOUT stateless for web)
            $facebookUser = Socialite::driver('facebook')->user();
            
            Log::info('Facebook Web OAuth: User data retrieved', [
                'facebook_id' => $facebookUser->getId(),
                'email' => $facebookUser->getEmail(),
                'name' => $facebookUser->getName()
            ]);

            // Validate email
            if (!$facebookUser->getEmail()) {
                Log::warning('Facebook Web OAuth: No email provided');
                return redirect()->route('login')
                    ->with('error', 'Email tidak tersedia dari Facebook. Pastikan Anda mengizinkan akses email.');
            }

            // Find or create user
            $user = User::where('email', $facebookUser->getEmail())->first();

            if ($user) {
                Log::info('Facebook Web OAuth: Existing user found', [
                    'user_id' => $user->id,
                    'email' => $user->email
                ]);
                
                // Update Facebook ID if not set
                if (!$user->facebook_id) {
                    $user->facebook_id = $facebookUser->getId();
                    $user->save();
                    Log::info('Facebook Web OAuth: Updated user with Facebook ID');
                }
            } else {
                Log::info('Facebook Web OAuth: Creating new user');
                
                $user = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'facebook_id' => $facebookUser->getId(),
                    'password' => Hash::make(uniqid()),
                    'email_verified_at' => now(),
                    'role' => 'parent',
                    'status' => 'approved'
                ]);
                
                Log::info('Facebook Web OAuth: New user created', [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role
                ]);
            }

            // Login user dengan remember = true
            Auth::login($user, true);
            
            Log::info('Facebook Web OAuth: User logged in', [
                'user_id' => $user->id,
                'auth_check' => Auth::check(),
                'auth_id' => Auth::id()
            ]);

            // Regenerate session untuk security
            $request->session()->regenerate();
            
            Log::info('=== FACEBOOK WEB LOGIN SUCCESS ===', [
                'user_id' => $user->id,
                'redirecting_to' => '/',
                'new_session_id' => session()->getId()
            ]);

            return redirect('/')
                ->with('success', 'Berhasil login dengan Facebook!');

        } catch (Exception $e) {
            Log::error('Facebook Web OAuth: Callback Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('login')
                ->with('error', 'Terjadi kesalahan saat login dengan Facebook.');
        }
    }

    /**
     * API: Redirect ke halaman login Facebook (untuk mobile/API)
     */
    public function apiRedirectToFacebook()
    {
        $url = Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl();
        return response()->json([
            'url' => $url
        ]);
    }

    /**
     * API: Handle callback dari Facebook (untuk mobile/API)
     */
    public function apiHandleFacebookCallback(Request $request)
    {
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();
            
            // Cari user berdasarkan Facebook ID
            $user = User::where('facebook_id', $facebookUser->id)->first();
            
            if ($user) {
                // User sudah ada, buat token
                $token = $user->createToken('facebook-login')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil login dengan Facebook',
                    'user' => $user,
                    'token' => $token
                ]);
            }
            
            // Cek apakah email sudah terdaftar
            $existingUser = User::where('email', $facebookUser->email)->first();
            
            if ($existingUser) {
                // Hubungkan Facebook ID ke akun yang ada
                $existingUser->update([
                    'facebook_id' => $facebookUser->id
                ]);
                $token = $existingUser->createToken('facebook-login')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'message' => 'Akun Facebook berhasil dihubungkan',
                    'user' => $existingUser,
                    'token' => $token
                ]);
            }
            
            // Buat user baru
            $newUser = User::create([
                'name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'facebook_id' => $facebookUser->id,
                'password' => Hash::make(Str::random(24)),
                'role' => 'orangtua',
                'status' => 'aktif'
            ]);
            
            $token = $newUser->createToken('facebook-login')->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendaftar dengan Facebook',
                'user' => $newUser,
                'token' => $token
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat login dengan Facebook',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
