<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    @auth
    <a class="navbar-brand" href="{{ route('dashboard') }}">
        <i class="container-logo fas fa-umbrella"></i> prediksi kekeringan
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Memastikan logo dimuat melalui HTTPS -->
    <img class="navbar-logo d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" src="{{ asset('assets/img/Logo-BMKG.png') }}" alt="Logo BMKG">
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item" type="submit">Keluar</button>
                </form>
            </div>
        </li>
    </ul>
    @endauth
</nav>
