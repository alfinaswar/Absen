<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intrack - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #223276;
            --secondary-color: #f8f9ff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f9ff 0%, #e4e7f5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 390px;
            padding: 30px 20px;
        }

        .logo {
            margin-bottom: 40px;
        }

        .logo img {
            height: 40px;
        }

        h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #202020;
        }

        .subtitle {
            font-size: 14px;
            color: #555;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .title-underline {
            width: 30px;
            height: 3px;
            background-color: var(--primary-color);
            margin: 8px 0 15px 0;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            border-radius: 25px;
            padding: 12px 20px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .input-icon-container {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 15px;
            color: #777;
        }

        .input-with-icon {
            padding-left: 45px;
        }

        .password-visibility {
            position: absolute;
            right: 15px;
            top: 15px;
            color: #777;
            cursor: pointer;
        }

        .forgot-password {
            text-align: right;
            font-size: 14px;
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
        }

        .login-btn {
            background-color: var(--primary-color);
            border: none;
            border-radius: 25px;
            padding: 12px;
            font-weight: 600;
            margin-top: 10px;
            transition: background-color 0.2s;
        }

        .login-btn:hover {
            background-color: #1a2861;
        }

        .login-btn i {
            margin-left: 5px;
        }

        .terms {
            font-size: 12px;
            color: #666;
            text-align: center;
            margin-top: 20px;
        }

        .terms a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-top: 3px;
        }

        .form-check-label {
            font-size: 14px;
            color: #444;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('assets/img/icon/iconlogin.png') }}" alt="Logo Intrack">
        </div>

        <!-- Login Form -->
        <div class="mb-4">
            <h1>Selamat datang di HexaTime</h1>
            <div class="title-underline"></div>
            <p class="subtitle">Selamat datang! Silahkan memasukkan email dan password anda untuk absensi.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" autocomplete="on" novalidate>
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email*</label>
                <div class="input-icon-container">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" class="form-control input-with-icon @error('email') is-invalid @enderror"
                        id="email" placeholder="Karywawan@email.com" name="email" required autocomplete="email"
                        autofocus>

                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi*</label>
                <div class="input-icon-container">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" class="form-control input-with-icon @error('password') is-invalid @enderror"
                        id="password" placeholder="Masukkan kata sandi" name="password" required
                        autocomplete="current-password">
                    <i class="fas fa-eye password-visibility" id="togglePassword"></i>

                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="rememberMe">
                        Ingat Saya
                    </label>
                </div>
                <a href="{{ route('password.request') }}" class="forgot-password">Lupa Kata Sandi?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 login-btn">
                Login <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <p class="terms mt-4">
            Dengan Login Anda menyetujui <a href="#">Kebijakan Privasi</a> dan <a href="#">Syarat dan Ketentuan
                Layanan</a>
        </p>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>