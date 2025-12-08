<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DoctorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorManagementController extends Controller
{
    // Tampilkan daftar dokter
    public function index()
    {
        $doctors = User::where('role', 'doctor')
            ->with('doctorProfile')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.doctors.index', compact('doctors'));
    }

    // Form tambah dokter baru
    public function create()
    {
        return view('admin.doctors.create');
    }

    // Simpan dokter baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'doctor',
            'status' => 'active',
        ]);

        // Buat profile kosong untuk dokter
        DoctorProfile::create([
            'user_id' => $user->id,
            'str_number' => '-',
            'specialization' => '-',
            'hospital_name' => '-',
            'phone_number' => '-',
            'years_of_experience' => 0,
        ]);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Akun dokter berhasil dibuat! Dokter dapat login dan melengkapi profile mereka.');
    }

    // Hapus dokter
    public function destroy($id)
    {
        $user = User::where('role', 'doctor')->findOrFail($id);
        $user->delete();

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Akun dokter berhasil dihapus.');
    }

    // Reset password dokter
    public function resetPassword(Request $request, $id)
    {
        $validated = $request->validate([
            'password' => 'required|min:6',
        ]);

        $user = User::where('role', 'doctor')->findOrFail($id);
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password dokter berhasil direset.');
    }
}