<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Staff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: rgba(40, 167, 69, 0.15); /* Hijau lembut */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-box {
            width: 100%;
            max-width: 500px;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .brand-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .brand-section img {
            height: 60px;
        }

        .brand-text h4 {
            margin: 0;
            font-weight: bold;
            color: #28a745;
        }

        .brand-text small {
            font-size: 0.9rem;
            color: #555;
        }

        .eye-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
        }
    </style>
</head>
<body>

<div class="register-box">
    <div class="brand-section">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <div class="brand-text">
            <h4>ELANG</h4>
            <small>Elektronik Arsip Lingkungan</small>
        </div>
    </div>

    <h5 class="text-center mb-4">Registrasi Staff</h5>

    @if ($errors->any())
        <div class="alert alert-danger p-2">
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="mb-3 position-relative">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" name="password" id="password" class="form-control" required>
            <span class="eye-icon" onclick="togglePassword('password', this)">
                <i class="fas fa-eye"></i>
            </span>
        </div>

        <div class="mb-3 position-relative">
            <label for="password_confirmation" class="form-label">Konfirmasi Sandi</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            <span class="eye-icon" onclick="togglePassword('password_confirmation', this)">
                <i class="fas fa-eye"></i>
            </span>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('login.form') }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-success">Daftar</button>
        </div>
    </form>
</div>

<script>
    function togglePassword(id, el) {
        const input = document.getElementById(id);
        const icon = el.querySelector('i');

        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace("fa-eye", "fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.replace("fa-eye-slash", "fa-eye");
        }
    }
</script>

</body>
</html>
