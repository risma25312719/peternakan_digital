<aside class="main-sidebar sidebar-dark-primary elevation-4 shadow-sm">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link border-bottom-0">
        <div class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-primary" style="width: 33px; height: 33px">
            <i class="fas fa-leaf text-white small"></i>
        </div>
        <span class="brand-text font-weight-bold ml-2">Ternak<span class="text-primary">Digital</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar px-0">
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
                
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header text-uppercase font-weight-bold opacity-50"><small>Manajemen Ternak</small></li>
                
                <!-- Data Ternak -->
                <li class="nav-item">
                    <a href="{{ route('ternak.index') }}" class="nav-link {{ request()->is('ternak*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cow"></i>
                        <p>Data Ternak</p>
                    </a>
                </li>

                <!-- Kandang -->
                <li class="nav-item">
                    <a href="{{ route('kandang.index') }}" class="nav-link {{ request()->is('kandang*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>Data Kandang</p>
                    </a>
                </li>

                <li class="nav-header text-uppercase font-weight-bold opacity-50"><small>Logistik & Kesehatan</small></li>

                <!-- Data Pakan -->
                <li class="nav-item">
                    <a href="{{ route('pakan.index') }}" class="nav-link {{ request()->is('pakan*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Stok Pakan</p>
                    </a>
                </li>

                <!-- Pemberian Pakan -->
                <li class="nav-item">
                    <a href="{{ route('pemberian-pakan.index') }}" class="nav-link {{ request()->is('pemberian-pakan*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>Pemberian Pakan</p>
                    </a>
                </li>

                <!-- Kesehatan -->
                <li class="nav-item">
                    <a href="{{ route('kesehatan.index') }}" class="nav-link {{ request()->is('kesehatan*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-heartbeat"></i>
                        <p>Catatan Kesehatan</p>
                    </a>
                </li>

                <li class="nav-header text-uppercase font-weight-bold opacity-50"><small>Keuangan</small></li>

                <!-- Penjualan -->
                <li class="nav-item">
                    <a href="{{ route('penjualan.index') }}" class="nav-link {{ request()->is('penjualan*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>Penjualan</p>
                    </a>
                </li>

                <!-- Detail Penjualan -->
                <li class="nav-item">
                    <a href="{{ route('detail-penjualan.index') }}" class="nav-link {{ request()->is('detail-penjualan*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>Laporan Detail</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<style>
    /* Custom UX Improvements */
    .nav-sidebar .nav-item .nav-link {
        transition: all 0.3s ease;
        border-radius: 0 50px 50px 0;
        margin-right: 10px;
    }
    .nav-sidebar .nav-link.active {
        background-color: #3c8dbc !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .nav-header {
        font-size: 0.75rem;
        padding: 1.5rem 1rem 0.5rem !important;
    }
</style>
