@extends('layouts.app')

@section('content')
<style>
    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 20px;
        background-color: #f1f5f9;
    }

    .login-container {
        background: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
    }

    .login-container h2 {
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .login-container button {
        width: 100%;
        padding: 12px;
        background-color: #198754;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .login-container button:hover {
        background-color: #145c39;
    }

    .login-container .register-link {
        margin-top: 15px;
        text-align: center;
        font-size: 14px;
    }
</style>

<div class="login-wrapper">
    <div class="login-container">
        <h2>Login</h2>

        {{-- ✅ Pesan sukses setelah registrasi --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- ❌ Error login --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 🔐 Form Login --}}
        <form action="/login" method="POST">
            @csrf
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Masuk</button>
        </form>

        {{-- 🔗 Link ke Register --}}
        <div class="register-link">
            Belum punya akun? <a href="{{ route('register.form') }}">Daftar di sini</a>
        </div>
    </div>
</div>
@endsection
