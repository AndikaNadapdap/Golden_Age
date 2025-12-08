<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\DoctorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
<<<<<<< HEAD
    // Tampilkan profile
=======
    // Tampilkan profile  
>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isParent()) {
            $children = $user->children;
            return view('profile.parent', compact('user', 'children'));
        } elseif ($user->isDoctor()) {
            $profile = $user->doctorProfile;
            return view('profile.doctor', compact('user', 'profile'));
        }
        
        return view('profile.index', compact('user'));
    }

    // Update profile user
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile berhasil diperbarui!');
    }

    // Update profile dokter
    public function updateDoctorProfile(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isDoctor()) {
            return back()->withErrors(['error' => 'Akses ditolak']);
        }

        $validated = $request->validate([
            'str_number' => 'required|string|unique:doctor_profiles,str_number,' . ($user->doctorProfile->id ?? 'NULL'),
            'specialization' => 'required|string|max:255',
            'hospital_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'years_of_experience' => 'required|integer|min:0',
            'bio' => 'nullable|string',
        ]);

        // Jika belum ada profile, buat baru
        if (!$user->doctorProfile) {
            $validated['user_id'] = $user->id;
            DoctorProfile::create($validated);
        } else {
            $user->doctorProfile->update($validated);
        }

        return back()->with('success', 'Profile dokter berhasil diperbarui!');
    }

    // Tambah anak baru
    public function addChild(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isParent()) {
            return back()->withErrors(['error' => 'Akses ditolak']);
        }

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'birth_date' => 'required|date|before_or_equal:today',
                'gender' => 'required|in:laki-laki,perempuan',
                'birth_weight' => 'nullable|numeric|min:0',
                'birth_height' => 'nullable|numeric|min:0',
                'blood_type' => 'nullable|string|max:10',
                'notes' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ], [
                'name.required' => 'Nama anak harus diisi',
                'birth_date.required' => 'Tanggal lahir harus diisi',
                'birth_date.before_or_equal' => 'Tanggal lahir tidak boleh lebih dari hari ini',
                'gender.required' => 'Jenis kelamin harus dipilih',
                'photo.image' => 'File harus berupa gambar',
                'photo.max' => 'Ukuran foto maksimal 2MB',
            ]);

            $validated['user_id'] = $user->id;

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('children', 'public');
                $validated['photo'] = $photoPath;
            }

            $child = Child::create($validated);

            return redirect()->route('profile.index')->with('success', 'Data anak berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    // Update data anak
    public function updateChild(Request $request, $id)
    {
        $user = Auth::user();
        $child = Child::where('user_id', $user->id)->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:laki-laki,perempuan',
            'birth_weight' => 'nullable|numeric|min:0',
            'birth_height' => 'nullable|numeric|min:0',
            'blood_type' => 'nullable|string|max:10',
            'notes' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($child->photo && Storage::disk('public')->exists($child->photo)) {
                Storage::disk('public')->delete($child->photo);
            }

            $photoPath = $request->file('photo')->store('children', 'public');
            $validated['photo'] = $photoPath;
        }

        $child->update($validated);

        return back()->with('success', 'Data anak berhasil diperbarui!');
    }

    // Hapus data anak
    public function deleteChild($id)
    {
        $user = Auth::user();
        $child = Child::where('user_id', $user->id)->findOrFail($id);

        // Hapus foto jika ada
        if ($child->photo && Storage::disk('public')->exists($child->photo)) {
            Storage::disk('public')->delete($child->photo);
        }

        $child->delete();

        return back()->with('success', 'Data anak berhasil dihapus!');
    }
}
