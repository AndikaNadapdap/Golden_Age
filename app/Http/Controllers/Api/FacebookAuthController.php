<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    /**
     * Get Facebook OAuth login URL
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLoginUrl()
    {
        try {
            $url = Socialite::driver('facebook')
                ->stateless()
                ->redirect()
                ->getTargetUrl();

            return response()->json([
                'success' => true,
                'data' => [
                    'login_url' => $url
                ],
                'message' => 'Facebook login URL generated successfully'
            ], 200);

        } catch (\Exception $e) {
            Log::error('API Facebook: Error generating login URL', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to generate login URL',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Login with Facebook access token (from mobile SDK)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginWithToken(Request $request)
    {
        try {
            $request->validate([
                'access_token' => 'required|string'
            ]);

            $accessToken = $request->access_token;

            // Verify token with Facebook Graph API
            $response = Http::get('https://graph.facebook.com/me', [
                'fields' => 'id,name,email',
                'access_token' => $accessToken
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Facebook access token'
                ], 401);
            }

            $facebookUser = $response->json();

            Log::info('API Facebook: User data from token', [
                'facebook_id' => $facebookUser['id'],
                'email' => $facebookUser['email'] ?? null,
                'name' => $facebookUser['name']
            ]);

            // Find or create user
            $user = User::where('facebook_id', $facebookUser['id'])->first();

            if (!$user && isset($facebookUser['email'])) {
                $user = User::where('email', $facebookUser['email'])->first();
                
                if ($user) {
                    // Link Facebook account
                    $user->update(['facebook_id' => $facebookUser['id']]);
                }
            }

            if (!$user) {
                // Create new user
                $user = User::create([
                    'name' => $facebookUser['name'],
                    'email' => $facebookUser['email'] ?? $facebookUser['id'] . '@facebook.com',
                    'facebook_id' => $facebookUser['id'],
                    'password' => Hash::make(Str::random(24)),
                    'role' => 'parent',
                    'status' => 'approved'
                ]);

                Log::info('API Facebook: New user created', ['user_id' => $user->id]);
            }

            // Create token
            $token = $user->createToken('facebook-auth')->plainTextToken;

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'facebook_id' => $user->facebook_id,
                        'role' => $user->role,
                        'status' => $user->status
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer'
                ],
                'message' => 'Successfully authenticated with Facebook token'
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('API Facebook: Login with token error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Authentication failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify Facebook access token
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyToken(Request $request)
    {
        try {
            $request->validate([
                'access_token' => 'required|string'
            ]);

            $accessToken = $request->access_token;

            // Verify with Facebook
            $response = Http::get('https://graph.facebook.com/me', [
                'fields' => 'id,name,email',
                'access_token' => $accessToken
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Facebook access token'
                ], 401);
            }

            $facebookUser = $response->json();

            return response()->json([
                'success' => true,
                'data' => [
                    'valid' => true,
                    'facebook_id' => $facebookUser['id'],
                    'name' => $facebookUser['name'],
                    'email' => $facebookUser['email'] ?? null
                ],
                'message' => 'Token is valid'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token verification failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle OAuth callback
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleCallback(Request $request)
    {
        try {
            if ($request->has('error')) {
                return response()->json([
                    'success' => false,
                    'message' => 'User cancelled Facebook login'
                ], 400);
            }

            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            Log::info('API Facebook: Callback user data', [
                'facebook_id' => $facebookUser->getId(),
                'email' => $facebookUser->getEmail(),
                'name' => $facebookUser->getName()
            ]);

            // Find or create user
            $user = User::where('facebook_id', $facebookUser->id)->first();

            if (!$user && $facebookUser->email) {
                $user = User::where('email', $facebookUser->email)->first();
                
                if ($user) {
                    $user->update(['facebook_id' => $facebookUser->id]);
                }
            }

            if (!$user) {
                $user = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email ?? $facebookUser->id . '@facebook.com',
                    'facebook_id' => $facebookUser->id,
                    'password' => Hash::make(Str::random(24)),
                    'role' => 'parent',
                    'status' => 'approved'
                ]);
            }

            $token = $user->createToken('facebook-auth')->plainTextToken;

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'facebook_id' => $user->facebook_id
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer'
                ],
                'message' => 'Login successful'
            ], 200);

        } catch (\Exception $e) {
            Log::error('API Facebook: Callback error', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Authentication failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get authenticated user
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated'
                ], 401);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'facebook_id' => $user->facebook_id,
                        'role' => $user->role,
                        'status' => $user->status,
                        'email_verified_at' => $user->email_verified_at,
                        'created_at' => $user->created_at
                    ]
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get user data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Logout user
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if ($user) {
                // Revoke current token
                $request->user()->currentAccessToken()->delete();

                Log::info('API Facebook: User logged out', ['user_id' => $user->id]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Successfully logged out'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Logout failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
