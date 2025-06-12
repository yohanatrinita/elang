<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ELANG – Elektronik Arsip Lingkungan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            scroll-behavior: smooth;
            font-family: 'Interphases Pro DemiBold', sans-serif;
        }

        .hero {
            position: relative;
            background-image: url('/images/bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            width: 100%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero .overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand img {
            height: 45px;
        }

        .elang-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.4rem;
            margin: 0;
            padding: 0;
        }

        .elang-subtitle {
            font-size: 0.75rem;
            margin-top: 2px;
        }

        .elang-section {
            background: linear-gradient(135deg, #e0f7fa, #f1f8e9);
            padding: 60px 0;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease-out;
        }

        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }

        table td, table th {
            white-space: pre-line;
        }

        footer {
            background: #f8f9fa;
            padding: 20px 0;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images/logo.png" alt="Logo DLH">
                <div style="line-height: 1;">
                    <p class="elang-title mb-0">ELANG</p>
                    <small class="elang-subtitle text-light">Sistem Elektronik Arsip Lingkungan</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav me-3">
                    <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/arsip">Arsip</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('arsip.pdf') }}">Download Rekap</a>
                    </li>
                    @if(auth()->user() && auth()->user()->role === 'admin')
                    <li class="nav-item"><a href="{{ route('admin.users.index') }}" class="nav-link">Verifikasi User</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="/informasi">Informasi</a></li>
                    @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link" style="display: inline; padding: 2; margin: 2;">
                                Logout
                            </button>
                        </form>
                    </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @if(session('warning'))
        <div style="background-color: #fff3cd; color: #856404; padding: 10px; border: 1px solid #ffeeba; margin-bottom: 10px; border-radius: 5px;">
            ⚠️  {{ session('warning') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="text-center">
        © {{ date('Y') }} Dinas Lingkungan Hidup Kabupaten Bogor
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fadeEls = document.querySelectorAll('.fade-in');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                    }
                });
            }, { threshold: 0.3 });

            fadeEls.forEach(el => observer.observe(el));
        });
    </script>
    @stack('scripts')

</body>
</html>
