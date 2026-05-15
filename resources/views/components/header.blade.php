<header class="pc-header">
    <style>
        /* Memastikan header menempel di paling atas viewport */
        .pc-header {
            top: 0px !important;
            margin-top: 0 !important;
            background: #1b7a3a !important; /* Hijau Farmkart */
            z-index: 1050 !important; /* Biar nggak ketutup elemen lain */
        }
        /* Penyesuaian warna konten header agar kontras */
        .pc-header .pc-head-link, 
        .pc-header .icon-search,
        .pc-header .form-control::placeholder {
            color: rgba(255, 255, 255, 0.9) !important;
        }
        .pc-header .form-control {
            background: rgba(255, 255, 255, 0.1) !important;
            border: none !important;
            color: #fff !important;
        }
    </style>
    <div class="header-wrapper">

      <div class="me-auto pc-mob-drp">
        <ul class="list-unstyled">
          <li class="pc-h-item pc-sidebar-collapse">
            <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
              <i class="ti ti-menu-2"></i>
            </a>
          </li>
          <li class="pc-h-item pc-sidebar-popup">
            <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
              <i class="ti ti-menu-2"></i>
            </a>
          </li>
          <li class="pc-h-item d-none d-md-inline-flex">
            <form class="header-search" action="#" method="GET">
              <i data-feather="search" class="icon-search"></i>
              <input type="search" name="q" class="form-control" placeholder="Search here. . ." />
            </form>
          </li>
        </ul>
      </div>

      <div class="ms-auto">
        <ul class="list-unstyled">

          <li class="dropdown pc-h-item header-user-profile">
            <a class="pc-head-link dropdown-toggle arrow-none me-0"
               data-bs-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
              <img src="{{ asset('template/dist/assets') }}/images/user/avatar-2.jpg"
                   alt="user-image" class="user-avtar wid-35" />
            </a>
            <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
              <div class="dropdown-header">
                <div class="d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('template/dist/assets') }}/images/user/avatar-2.jpg"
                         alt="user-image" class="user-avtar wid-35" />
                    <div>
                      <h6 class="mb-0">{{ auth()->user()->name ?? 'Guest' }}</h6>
                      <small class="text-muted">{{ auth()->user()->role ?? 'Administrator' }}</small>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <a href="#" title="Settings" class="text-dark"><i class="ti ti-settings" style="font-size: 1.2rem;"></i></a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="bg-transparent border-0 p-0" title="Logout">
                            <i class="ti ti-power text-danger" style="font-size: 1.2rem;"></i>
                        </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </li>

        </ul>
      </div>

    </div>
  </header>
