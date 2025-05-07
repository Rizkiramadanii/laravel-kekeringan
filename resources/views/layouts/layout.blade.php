<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title', 'Sistem Prediksi Kekeringan BMKG Bengkulu')</title>

    <!-- CSS -->
    <link href="{{ secure_asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('assets/css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

    <!-- Icon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

</head>
<body>
    @include('layouts.navbar')
    <div id="layoutSidenav">
        @include('layouts.sidenav')

        <div id="layoutSidenav_content">
            <main class="container mt-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- JS Vendor -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- JS Custom -->
    <script src="{{ secure_asset('assets/js/scripts.js') }}"></script>
    <script src="{{ secure_asset('assets/demo/datatables.js') }}"></script>
    
</body>
</html>
