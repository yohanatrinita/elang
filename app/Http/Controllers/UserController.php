<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan daftar user untuk diverifikasi
    public function index()
    {
        $users = User::where('role', 'staff')->where('is_verified', false)->get();
        return view('admin.users.index', compact('users'));
    }

    // Verifikasi user (aktifkan akun)
    public function verify($id)
    {
        $user = User::findOrFail($id);
        $user->is_verified = true;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diverifikasi.');
    }

    // Tolak verifikasi (hapus user)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User ditolak dan dihapus.');
    }

    // Hapus akun terverifikasi dengan konfirmasi password admin
    public function secureDestroy(Request $request, $id)
    {
        $request->validate([
            'admin_password' => 'required',
        ]);

        if (!Hash::check($request->admin_password, Auth::user()->password)) {
            return back()->withErrors(['admin_password' => 'Password salah.']);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil dihapus.');
    }

    public function secureDelete(Request $request, $id)
    {
        $request->validate([
            'admin_password' => 'required',
        ]);

        // Cek apakah password admin cocok
        if (!Hash::check($request->admin_password, Auth::user()->password)) {
            return back()->withErrors(['admin_password' => 'Password salah!']);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil dihapus.');
    }
}
