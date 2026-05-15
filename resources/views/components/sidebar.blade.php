<style>
    /* Styling khusus logo biar mirip gambar referensi */
    .brand-container {
        display: flex;
        align-items: center;
        padding: 15px 20px !important;
        text-decoration: none !important;
    }
    
    .logo-text {
        font-size: 18px !important; /* Dikecilkan lagi biar lebih rapi */
        font-weight: 800 !important;
        color: #1b7a3a !important; /* Hijau Farmkart */
        letter-spacing: -1px;
        margin-right: 5px;
    }

    .icon-accent {
        color: #e67e22 !important; 
        font-size: 18px !important;
    }
</style>

<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <!-- Logo Area -->
        <div class="m-header">
            <a href="{{ url('/') }}" class="brand-container">
                <span class="logo-text">Ternak Digital</span>
                <i class="ti ti-leaf icon-accent"></i>
            </a>
        </div>

        <div class="navbar-content">
            <ul class="pc-navbar">

                <!-- DASHBOARD -->
                <li class="pc-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-layout-grid"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <!-- DATA TERNAK -->
                <li class="pc-item {{ request()->routeIs('ternak.*') ? 'active' : '' }}">
                    <a href="{{ route('ternak.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-clipboard-list"></i></span>
                        <span class="pc-mtext">Data Ternak</span>
                    </a>
                </li>

                <!-- KANDANG -->
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-home"></i></span>
                        <span class="pc-mtext">Kandang</span>
                    </a>
                </li>

                <!-- PAKAN -->
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-bucket"></i></span>
                        <span class="pc-mtext">Pakan</span>
                    </a>
                </li>

                <!-- KESEHATAN -->
                <li class="pc-item">
                    <a href="#" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-heart-rate-monitor"></i></span>
                        <span class="pc-mtext">Kesehatan</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>