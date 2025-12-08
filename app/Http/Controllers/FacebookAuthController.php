<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FacebookAuthController extends Controller
{
    /**
     * Redirect user ke halaman login Facebook
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle callback dari Facebook
     */
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            
            // Cari user berdasarkan Facebook ID
            $user = User::where('facebook_id', $facebookUser->id)->first();
            
            if ($user) {
                // Jika user sudah ada dengan Facebook ID ini, langsung login
                Auth::login($user, true);
                return redirect()->intended('/')->with('success', 'Berhasil login dengan Facebook!');
            }
            
            // Cek apakah email sudah terdaftar
            $existingUser = User::where('email', $facebookUser->email)->first();
            
            if ($existingUser) {
                // Jika email sudah ada, hubungkan Facebook ID ke akun tersebut
                $existingUser->update([
                    'facebook_id' => $facebookUser->id
                ]);
                Auth::login($existingUser, true);
                return redirect()->intended('/')->with('success', 'Akun Facebook berhasil dihubungkan!');
            }
            
            // Buat user baru dengan role orangtua
            $newUser = User::create([
                'name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'facebook_id' => $facebookUser->id,
                'password' => Hash::make(Str::random(24)), // Random password
                'role' => 'orangtua',
                'status' => 'aktif'
            ]);
            
            Auth::login($newUser, true);
            return redirect()->intended('/')->with('success', 'Berhasil mendaftar dengan Facebook!');
            
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Facebook: ' . $e->getMessage());
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
