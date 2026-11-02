<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Garasi Cuci Motor') }} - Steam & Care Pro</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts and Base Styles via Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --dark-bg: #0b0f19;
            --dark-surface: #131c2e;
            --dark-card: #1e293b;
            --dark-border: #334155;
            --accent-blue: #3b82f6;
            --accent-amber: #f59e0b;
            --accent-emerald: #10b981;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--dark-bg);
            color: #e2e8f0;
            min-height: 100vh;
        }

        .navbar-otomotif {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            border-bottom: 1px solid var(--dark-border);
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 1040;
        }

        .navbar-brand-logo {
            font-weight: 800;
            letter-spacing: -0.5px;
            font-size: 1.25rem;
            color: #f8fafc !important;
            display: inline-flex;
            align-items: center;
        }

        .card-custom {
            background-color: var(--dark-card);
            border: 1px solid var(--dark-border);
            border-radius: 14px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -4px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-custom:hover {
            border-color: #475569;
        }

        .table-custom {
            --bs-table-bg: transparent;
            --bs-table-color: #e2e8f0;
            border-color: var(--dark-border);
        }

        .table-custom th {
            background-color: #172033;
            color: #94a3b8;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
            padding: 12px 14px;
            border-bottom: 2px solid var(--dark-border);
        }

        .table-custom td {
            padding: 14px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(51, 65, 85, 0.6);
        }

        .table-hover tbody tr:hover td {
            background-color: rgba(255, 255, 255, 0.03);
        }

        .plat-badge {
            background: #020617;
            color: #f8fafc;
            border: 1.5px solid #475569;
            font-family: 'Courier New', Courier, monospace;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 1.5px;
            padding: 5px 10px;
            border-radius: 6px;
            display: inline-block;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
        }

        .form-control, .form-select {
            background-color: #0f172a !important;
            border: 1px solid var(--dark-border) !important;
            color: #f8fafc !important;
            border-radius: 8px;
            padding: 10px 14px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-blue) !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25) !important;
        }

        .form-control::placeholder {
            color: #64748b !important;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.88rem;
            color: #cbd5e1;
            margin-bottom: 6px;
        }

        .user-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.95rem;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.4);
        }

        .dropdown-menu {
            z-index: 1060;
        }

        .dropdown-menu-dark-custom {
            background-color: #1e293b !important;
            border: 1px solid #334155 !important;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.6);
            padding: 8px;
        }

        .dropdown-menu-dark-custom .dropdown-item {
            color: #cbd5e1;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .dropdown-menu-dark-custom .dropdown-item:hover,
        .dropdown-menu-dark-custom .dropdown-item:focus {
            background-color: #2e3d54 !important;
            color: #ffffff !important;
        }

        .nav-link {
            font-weight: 600;
            font-size: 0.92rem;
            color: #cbd5e1 !important;
            padding: 8px 14px !important;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.05);
        }

        /* Mobile Navbar & Hamburger Styling */
        .navbar-toggler {
            padding: 0.45rem 0.65rem;
            border: 1px solid var(--dark-border) !important;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.05);
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3) !important;
            outline: none;
        }

        .navbar-toggler-icon {
            filter: invert(1);
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: #1e293b;
                padding: 16px;
                border-radius: 12px;
                margin-top: 12px;
                border: 1px solid var(--dark-border);
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.6);
                position: relative;
                z-index: 1050;
            }

            .navbar-nav .dropdown-menu {
                background-color: #0f172a !important;
                border: 1px solid var(--dark-border) !important;
                margin-top: 8px;
                padding: 8px;
            }

            .navbar-nav .nav-link {
                padding: 10px 14px !important;
            }
        }

        /* Print Media Styling */
        @media print {
            .navbar, .btn, .no-print, .pagination, .alert, header {
                display: none !important;
            }
            body {
                background-color: #ffffff !important;
                color: #000000 !important;
                font-size: 11pt;
            }
            .card-custom, .card {
                border: none !important;
                box-shadow: none !important;
                background: transparent !important;
            }
            .table-custom th {
                background-color: #f1f5f9 !important;
                color: #000000 !important;
            }
            .table-custom td {
                color: #000000 !important;
            }
            .plat-badge {
                background: #f8fafc !important;
                color: #000000 !important;
                border: 1px solid #000 !important;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-otomotif sticky-top">
            <div class="container-fluid px-lg-4">
                <a class="navbar-brand navbar-brand-logo" href="{{ url('/home') }}">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" width="38" height="38" class="rounded-circle border border-warning shadow-sm me-2"> GARASI
                    <span class="badge bg-warning text-dark fw-bold ms-2 px-2 py-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">STEAM PRO</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                        @auth
                            <li class="nav-item me-1">
                                <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                    <i class="bi bi-house-door me-1 text-primary"></i> Dashboard
                                </a>
                            </li>

                            <!-- Dropdown Data Master -->
                            <li class="nav-item dropdown me-1">
                                <a class="nav-link dropdown-toggle {{ request()->is('paket*') || request()->is('pelanggan*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-database me-1 text-info"></i> Data Master
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-dark-custom">
                                    <li><h6 class="dropdown-header text-uppercase text-secondary" style="font-size: 0.7rem;">Paket Cuci</h6></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('paket.index') }}">
                                            <i class="bi bi-droplet-half me-2 text-primary"></i> Daftar Paket Cuci
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('paket.create') }}">
                                            <i class="bi bi-plus-circle me-2 text-success"></i> + Tambah Paket Baru
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider border-secondary my-1"></li>
                                    <li><h6 class="dropdown-header text-uppercase text-secondary" style="font-size: 0.7rem;">Pelanggan & Motor</h6></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('pelanggan.index') }}">
                                            <i class="bi bi-people me-2 text-info"></i> Data Pelanggan
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('pelanggan.create') }}">
                                            <i class="bi bi-person-plus me-2 text-success"></i> + Tambah Pelanggan
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Dropdown Transaksi Cuci -->
                            <li class="nav-item dropdown me-1">
                                <a class="nav-link dropdown-toggle {{ request()->is('transaksi*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-receipt me-1 text-warning"></i> Transaksi Cuci
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-dark-custom">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('transaksi.index') }}">
                                            <i class="bi bi-hourglass-split me-2 text-warning"></i> Data Antrean & Transaksi
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('transaksi.create') }}">
                                            <i class="bi bi-plus-square me-2 text-success"></i> + Input Transaksi Baru
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Dropdown Laporan -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-printer me-1 text-success"></i> Laporan
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-dark-custom">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('paket.laporan') }}">
                                            <i class="bi bi-file-earmark-text me-2 text-primary"></i> Laporan Paket Cuci
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('pelanggan.laporan') }}">
                                            <i class="bi bi-file-earmark-person me-2 text-info"></i> Laporan Data Pelanggan
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('transaksi.laporan') }}">
                                            <i class="bi bi-cash-coin me-2 text-success"></i> Laporan Pendapatan Transaksi
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right me-1"></i> {{ __('Login') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="user-avatar me-2">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <div class="d-none d-md-block text-start">
                                        <span class="d-block fw-bold text-white lh-sm" style="font-size: 0.88rem;">{{ Auth::user()->name }}</span>
                                        <small class="text-secondary" style="font-size: 0.72rem;">Kasir Garasi</small>
                                    </div>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark dropdown-menu-dark-custom" style="min-width: 240px;" aria-labelledby="navbarDropdown">
                                    <div class="px-3 py-2 border-bottom border-secondary mb-2">
                                        <div class="fw-bold text-white">{{ Auth::user()->name }}</div>
                                        <div class="text-secondary small">{{ Auth::user()->email }}</div>
                                        <div class="mt-2">
                                            <span class="badge bg-success-subtle text-success border border-success-subtle">
                                                <i class="bi bi-dot"></i> Kasir Online
                                            </span>
                                        </div>
                                    </div>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person-gear me-2 text-info"></i> Pengaturan Profil
                                    </a>
                                    <div class="dropdown-divider border-secondary my-1"></div>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid px-lg-4">
                <!-- Flash Notification Session -->
                @if (session('pesan'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" style="background-color: #064e3b; color: #a7f3d0;" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            <div>{{ session('pesan') }}</div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" style="background-color: #064e3b; color: #a7f3d0;" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" style="background-color: #7f1d1d; color: #fecaca;" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                            <div>{{ session('error') }}</div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap 5.3 JavaScript Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
