<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <!-- UTAMA -->
                <div class="sb-sidenav-menu-heading">UTAMA</div>
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    Beranda
                </a>

                <!-- MENU -->
                <div class="sb-sidenav-menu-heading">MENU</div>
                <a class="nav-link" href="{{ route('prediksi') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Prediksi
                </a>
                <a class="nav-link" href="{{ route('hasil.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                    Histori
                </a>

                <!-- LAINNYA -->
                <div class="sb-sidenav-menu-heading">LAINNYA</div>
                <a class="nav-link" href="{{ route('about') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>
                    Tentang Kami
                </a>

                <!-- LOGOUT -->
                <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                    Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Footer Sidenav -->
        <div class="sb-sidenav-footer">
            <div class="small">Masuk sebagai: 
                @auth('admin')
                    {{ Auth::guard('admin')->user()->name }}
                @endauth
            </div>
            BMKG Bengkulu
        </div>
    </nav>
</div>
