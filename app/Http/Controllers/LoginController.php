<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function showLoginForm()
    {
        // Jika user sudah login, langsung alihkan ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('login-form');  // Ganti dengan nama view login kamu
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('warning', 'Email tidak ditemukan.');
        }

        // Cek password
        if (Hash::check($request->password, $user->password)) {

            // Cek apakah akun sudah diverifikasi
            if (!$user->is_verified) {
                return back()->with('error', 'Akun Anda belum diverifikasi oleh admin.');
            }

            // Login user secara manual
            Auth::login($user);

            // Arahkan sesuai role jika diinginkan
            // if ($user->role === 'admin') {
            //     return redirect('/admin/dashboard');
            // }

            // Redirect ke dashboard (bisa diarahkan ulang sesuai role)
            return redirect()->intended('/dashboard');

        } else {
            return back()->with('warning', 'Password salah.');
        }
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form')->with('success', 'Berhasil logout.');
    }
}
