<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>PT. Gorby Putra Utama - Document Portal</title>

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
            background: #f5f7fb;
            color: #1f2937;
            font-family: 'Segoe UI', sans-serif;
        }

        .hero-card {
            border: none;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        }

        .hero-title {
            font-size: 2.3rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .hero-text {
            color: #6b7280;
            line-height: 1.8;
        }

        .btn-main {
            background: #2563eb;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
        }

        .btn-main:hover {
            background: #1d4ed8;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            color: #4b5563;
        }

        .feature-item i {
            color: #22c55e;
            font-size: 18px;
        }

        .logo-box {
            width: 50px;
            height: 50px;
            background: #2563eb;
            color: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 20px;
        }

        .hero-image {
            width: 100%;
            max-width: 550px;
        }
    </style>
</head>

<body>

<div class="container py-5 min-vh-100 d-flex flex-column justify-content-center">

    <!-- Header -->
    <header class="d-flex justify-content-between align-items-center mb-5">

        <div class="d-flex align-items-center gap-3">

            <div class="logo-box">
                G
            </div>

            <div>
                <h4 class="mb-0 fw-bold">
                    GPU & GE
                </h4>

                <small class="text-muted">
                    Portal Hauling Management
                </small>
            </div>

        </div>

        @if (Route::has('login'))

            <div>

                @auth

                    <a
                        href="{{ url('/dashboard') }}"
                        class="btn btn-primary rounded-pill px-4"
                    >
                        Dashboard
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="btn btn-outline-primary rounded-pill px-4"
                    >
                        Login
                    </a>

                @endauth

            </div>

        @endif

    </header>

    <!-- Main -->
    <div class="card hero-card">

        <div class="row g-0 align-items-center">

            <!-- Left -->
            <div class="col-lg-6 p-5">

                <span class="badge bg-primary-subtle text-primary mb-3 px-3 py-2">
                    PT. Gorby Putra Utama
                </span>

                <h1 class="hero-title mb-4">
                    Selamat Datang di Portal Hauling GPU-GE
                </h1>

                <p class="hero-text mb-4">
                    Portal Hauling adalah aplikasi management hauling yang dirancang
                    khusus untuk PT. GPU & GE. Sistem ini memudahkan pengelolaan
                    operasional hauling secara cepat, aman, dan terintegrasi.
                </p>

                <!-- Features -->
                <div class="mb-4">

                    <div class="feature-item">
                        <i class="bi bi-check-circle-fill"></i>
                        Keamanan data terenkripsi dan aman
                    </div>

                    <div class="feature-item">
                        <i class="bi bi-check-circle-fill"></i>
                        Akses cepat dan terpusat
                    </div>

                    <div class="feature-item">
                        <i class="bi bi-check-circle-fill"></i>
                        Terintegrasi dengan sistem internal
                    </div>

                </div>

                <!-- Button -->
                @if (Route::has('login'))

                    @auth

                        <a
                            href="{{ url('/dashboard') }}"
                            class="btn btn-primary btn-main"
                        >
                            <i class="bi bi-speedometer2 me-2"></i>
                            Buka Dashboard
                        </a>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="btn btn-primary btn-main"
                        >
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Masuk Sekarang
                        </a>

                    @endauth

                @endif

            </div>

            <!-- Right -->
            <div class="col-lg-6 text-center p-4">

                <img
                    src="{{ asset('images/mining.png') }}"
                    alt="Mining Illustration"
                    class="img-fluid hero-image"
                >

            </div>

        </div>

    </div>

    <!-- Footer -->
    <footer class="text-center mt-5 text-muted small">
        © {{ date("Y") }} PT. GPU & GE. All rights reserved.
    </footer>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    console.log("Make With ❤️ by Komang Chandra Winata");
</script>

</body>
</html>