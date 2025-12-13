<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OtpCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OtpAuthController extends Controller
{
    //public function __construct()
   // {
    //    $this->middleware(function ($request, $next) {
      //      if (auth()->check() && auth()->user()->role !== 'parent') {
        //        abort(403);
          //  }
            //return $next($request);
      //  })->except(['logout']);
    //}

    public function showRequestForm()
    {
        return view('auth.otp-request');
    }

    public function requestOtp(Request $request)
    {
        $data = $request->validate([
            'phone' => ['required','regex:/^[0-9]{10,15}$/']
        ]);

        $phone = $data['phone'];

        // generate 6 digit OTP
        $otp = (string) random_int(100000, 999999);

        // invalidate OTP lama (opsional)
        OtpCode::where('identifier', $phone)
            ->where('channel', 'whatsapp')
            ->whereNull('used_at')
            ->update(['used_at' => now()]);

        $record = OtpCode::create([
            'identifier' => $phone,
            'channel' => 'whatsapp',
            'otp_hash' => Hash::make($otp),
            'expires_at' => now()->addMinutes(5),
            'attempts' => 0,
        ]);

        // Kirim OTP ke WhatsApp (contoh Fonnte API, ganti dengan provider kamu)
        $waApiKey = env('WA_API_KEY');
        $waSender = env('WA_SENDER');
        $waUrl = 'https://api.fonnte.com/send';
        $message = "Kode OTP kamu: {$otp} (berlaku 5 menit)";
        try {
            $response = \Http::withHeaders([
                'Authorization' => $waApiKey
            ])->asForm()->post($waUrl, [
                'target' => $phone,
                'message' => $message,
                'countryCode' => '62',
                'sender' => $waSender
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['phone' => 'Gagal mengirim OTP ke WhatsApp.']);
        }

        // arahkan ke form verifikasi
        return redirect()->route('otp.verify.form', ['phone' => $phone])
            ->with('status', 'OTP sudah dikirim ke WhatsApp.');
    }

    public function showVerifyForm(Request $request)
    {
        $phone = $request->query('phone');
        return view('auth.otp-verify', compact('phone'));
    }

    public function verifyOtp(Request $request)
    {
        $data = $request->validate([
            'phone' => ['required','regex:/^[0-9]{10,15}$/'],
            'otp' => ['required','digits:6'],
        ]);

        $phone = $data['phone'];

        $otpRecord = OtpCode::where('identifier', $phone)
            ->where('channel', 'whatsapp')
            ->whereNull('used_at')
            ->latest()
            ->first();

        if (!$otpRecord) {
            return back()->withErrors(['otp' => 'OTP tidak ditemukan / sudah dipakai.']);
        }

        if ($otpRecord->isExpired()) {
            $otpRecord->update(['used_at' => now()]);
            return back()->withErrors(['otp' => 'OTP sudah expired. Request ulang.']);
        }

        if ($otpRecord->attempts >= 5) {
            $otpRecord->update(['used_at' => now()]);
            return back()->withErrors(['otp' => 'Terlalu banyak percobaan. Request ulang OTP.']);
        }

        $otpRecord->increment('attempts');

        if (!Hash::check($data['otp'], $otpRecord->otp_hash)) {
            return back()->withErrors(['otp' => 'OTP salah.']);
        }

        // tandai OTP terpakai
        $otpRecord->update(['used_at' => now()]);

        // Auto create user jika belum ada (opsional)
        $user = User::where('phone', $phone)->first();

        if ($user) {
            // ❌ Tolak admin & dokter
            if (in_array($user->role, ['admin', 'doctor'])) {
                return redirect()->route('login')
                    ->withErrors(['phone' => 'Admin dan dokter wajib login menggunakan email & password.']);
            }
        } else {
            // ✅ Buat user BARU sebagai parent
            $user = User::create([
                'name' => 'Orang Tua',
                'phone' => $phone,
                'role' => 'parent',
                'password' => bcrypt(str()->random(32)),
            ]);
        }

       Auth::login($user);
       return redirect()->route('home')->with('status', 'Login WhatsApp berhasil!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('otp.request.form');
    }
}
