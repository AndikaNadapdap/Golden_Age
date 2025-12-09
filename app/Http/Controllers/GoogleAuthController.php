<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        try {
            Log::info('=== GOOGLE LOGIN START ===', [
                'session_id' => session()->getId()
            ]);
            
            return Socialite::driver('google')->redirect();
            
        } catch (Exception $e) {
            Log::error('Google OAuth Redirect Error', [
                'error' => $e->getMessage()
            ]);
            
            return redirect()->route('login')
                ->with('error', 'Gagal menghubungkan ke Google: ' . $e->getMessage());
        }
    }

    /**
     * Handle Google callback
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            Log::info('=== GOOGLE CALLBACK RECEIVED ===', [
                'full_url' => $request->fullUrl(),
                'all_params' => $request->all(),
                'session_id' => session()->getId(),
                'has_code' => $request->has('code'),
                'has_error' => $request->has('error')
            ]);
            
            // Check for error from Google
            if ($request->has('error')) {
                Log::warning('Google OAuth: Error from Google', [
                    'error' => $request->input('error')
                ]);
                
                return redirect()->route('login')
                    ->with('error', 'Login Google dibatalkan.');
            }

            // Check if code exists
            if (!$request->has('code')) {
                Log::error('Google OAuth: No authorization code');
                return redirect()->route('login')
                    ->with('error', 'Kode otorisasi tidak ditemukan.');
            }

            Log::info('Google OAuth: Getting user from Google');

            // Get user from Google
            $googleUser = Socialite::driver('google')->user();
            
            Log::info('Google OAuth: User data retrieved', [
                'google_id' => $googleUser->getId(),
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName()
            ]);

            // Validate email
            if (!$googleUser->getEmail()) {
                Log::warning('Google OAuth: No email provided');
                return redirect()->route('login')
                    ->with('error', 'Email tidak tersedia dari Google.');
            }
            
            // Cari user berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->id)
                       ->orWhere('email', $googleUser->email)
                       ->first();

            if ($user) {
                Log::info('Google OAuth: Existing user found', [
                    'user_id' => $user->id
                ]);
                
                // Update google_id jika belum ada
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->id,
                    ]);
                    Log::info('Google OAuth: Updated user with Google ID');
                }
            } else {
                Log::info('Google OAuth: Creating new user');
                
                // Buat user baru dengan role parent
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Str::random(24)), // Random password
                    'role' => 'parent', // Default role untuk Google login
                    'status' => 'approved',
                ]);
                
                Log::info('Google OAuth: New user created', [
                    'user_id' => $user->id
                ]);
            }

            // Login user
            Auth::login($user, true); // remember = true
            
            Log::info('Google OAuth: User authenticated', [
                'user_id' => $user->id,
                'auth_check' => Auth::check(),
                'auth_user' => Auth::user()?->email
            ]);

            // Regenerate session untuk keamanan
            $request->session()->regenerate();
            
            Log::info('=== GOOGLE LOGIN SUCCESS ===', [
                'redirecting_to' => 'home',
                'new_session_id' => session()->getId()
            ]);

            return redirect()->route('home')
                ->with('success', 'Berhasil login dengan Google!');

        } catch (Exception $e) {
            Log::error('Google OAuth: Callback Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('login')
                ->with('error', 'Terjadi kesalahan saat login: ' . $e->getMessage());
        }
    }

    /**
     * API: Redirect to Google OAuth (return URL)
     */
    public function apiRedirectToGoogle()
    {
        $url = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
        
        return response()->json([
            'success' => true,
            'url' => $url,
        ]);
    }

    /**
     * API: Handle Google callback and return token
     */
    public function apiHandleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            // Cari user berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->id)
                       ->orWhere('email', $googleUser->email)
                       ->first();

            if ($user) {
                // Update google_id jika belum ada
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->id,
                    ]);
                }
            } else {
                // Buat user baru dengan role parent
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Str::random(24)),
                    'role' => 'parent',
                    'status' => 'approved',
                ]);
            }

            // Generate token untuk API (jika menggunakan Sanctum)
            // $token = $user->createToken('google-auth')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                // 'token' => $token, // Uncomment jika menggunakan Sanctum
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal login dengan Google',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
