<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('login-form');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Cek apakah user sudah diverifikasi admin
            if (!$user->is_verified) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda belum diverifikasi oleh admin.',
                ]);
            }

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Login gagal! Periksa email dan password Anda.',
        ]);
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('register-form'); // Sesuaikan dengan file view Anda
    }

    // Menangani registrasi user baru
    public function register(Request $request)
    {
        // Logging untuk debugging (opsional)
        \Log::info('Masuk ke register()');

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        \Log::info('Validasi berhasil');

        // Simpan user baru ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff', // Penting: agar bisa difilter di admin
            'is_verified' => false, // Penting: agar butuh verifikasi admin
        ]);

        \Log::info('User berhasil dibuat. ID: ' . $user->id);

        // Redirect ke login dengan pesan sukses
        return redirect('/login')->with('success', 'Registrasi berhasil! Tunggu verifikasi dari admin.');
    }


    // Menampilkan form lupa password
    public function showForgotForm()
    {
        return view('auth.passwords.email');
    }

    // Kirim link reset password
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
