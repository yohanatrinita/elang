<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');  // Pastikan ada view 'auth.login'
    }

    // Menangani login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Proses login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/dashboard'); // Redirect ke halaman yang dituju
        }

        return back()->withErrors([
            'email' => 'Login gagal! Periksa email dan password Anda.',
        ]);
    }

    // Log out user
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
