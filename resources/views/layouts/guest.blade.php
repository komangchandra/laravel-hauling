<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e4e3f1ff, #888c96ff);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            border: none;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .login-header {
            background: white;
            padding: 40px 35px 20px;
            text-align: center;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: #4f46e5;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 32px;
            font-weight: bold;
        }

        .login-body {
            background: white;
            padding: 20px 35px 40px;
        }

        .form-control {
            height: 52px;
            border-radius: 14px;
        }

        .input-group-text {
            border-radius: 14px 0 0 14px;
            background: white;
        }

        .btn-login {
            height: 52px;
            border-radius: 14px;
            font-weight: 600;
            background: #4f46e5;
            border: none;
        }

        .btn-login:hover {
            background: #4338ca;
        }

        .toggle-password {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="card login-card">

        <!-- Header -->
        <div class="login-header">

            <div class="logo-circle">
                {{ substr(config('app.name'), 0, 1) }}
            </div>

            <h2 class="fw-bold mb-2">
                Selamat Datang di {{ config('app.name') }}
            </h2>

            <p class="text-muted mb-0">
                Silahkan masuk ke akun Anda untuk melanjutkan
            </p>

        </div>

        <!-- Content -->
        <div class="login-body">
            {{ $slot }}
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>