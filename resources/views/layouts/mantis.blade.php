<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title', 'Peternakan Digital')</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/dist/assets/css/style.css') }}" />

    <style>
        /* CSS GLOBAL UNTUK SIDEBAR FARMKART */
        .pc-sidebar {
            background: #ffffff !important;
            border-right: 1px solid #f0f0f0 !important;
            border-radius: 0 40px 40px 0 !important;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.02) !important;
        }

        .pc-sidebar .pc-link {
            border-radius: 15px !important;
            margin: 8px 20px !important;
            font-weight: 600 !important;
            color: #8a92a6 !important;
        }

        .pc-sidebar .pc-item.active > .pc-link {
            background: #1b7a3a !important; 
            color: #ffffff !important;
            box-shadow: 0 8px 20px rgba(27, 122, 58, 0.2) !important;
        }

        .pc-sidebar .pc-item.active .pc-micon i {
            color: #ffffff !important;
        }
    </style>

    @stack('styles')
</head>

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">

    <!-- Pre-loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- ==================== SIDEBAR COMPONENT ==================== -->
    @include('components.sidebar') 
    <!-- Atau kalau lo pake x-component: <x-sidebar /> -->

    <!-- ==================== HEADER ==================== -->
    <header class="pc-header">
        <div class="header-wrapper">
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <li class="pc-h-item">
                        <a href="#" class="pc-head-link" id="mobile-collapse"><i class="ti ti-menu-2"></i></a>
                    </li>
                </ul>
            </div>
            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button">
                            <i class="ti ti-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center py-3">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ Auth::user()->name ?? 'Ismi Yulia' }}</h6>
                                    <span class="text-muted text-sm">Peternak Digital</span>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ti ti-logout"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <div class="pc-container">
        <div class="pc-content">
            @yield('content')
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="m-0 text-muted">&copy; {{ date('Y') }} Peternakan Digital.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="m-0 text-muted">Sistem Manajemen Peternakan</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('template/dist/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('template/dist/assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('template/dist/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/dist/assets/js/pcoded.js') }}"></script>

    <script>
        layout_change('light');
        font_change("Public-Sans");
    </script>

    @stack('scripts')
</body>
</html>