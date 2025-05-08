<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login-form');  // Nama view yang digunakan untuk login
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('warning', 'Email tidak ditemukan.');
        }

        // Cek password yang dimasukkan
        if (Hash::check($request->password, $user->password)) {
            Auth::login($user);  // Login user secara manual
            return redirect()->intended('/dashboard');  // Redirect ke dashboard
        } else {
            return back()->with('warning', 'Password salah.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.form')->with('success', 'Berhasil logout.');
    }
}
