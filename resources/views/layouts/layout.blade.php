<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title', 'Sistem Prediksi Kekeringan BMKG Bengkulu')</title>

    <!-- CSS -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

    <!-- Icon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>

    <style>
        /* Font default */
        body {
            font-family: 'Arial', sans-serif;
            font-size: 1rem;
        }
    
        /* Container padding */
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
    
        /* Responsive table */
        table {
            width: 100%;
        }
    
        .table-responsive {
            overflow-x: auto;
        }
    
        /* Responsive layout pada layar kecil */
        @media (max-width: 768px) {
            body {
                font-size: 0.95rem;
            }
    
            h1, h2, h3 {
                font-size: 1.1rem;
            }
    
            .btn {
                font-size: 0.875rem;
                padding: 0.4rem 0.75rem;
            }
    
            /* Jangan sembunyikan sidebar! Biarkan toggle bekerja */
            /* Pastikan layout menyesuaikan */
            #layoutSidenav_content {
                width: 100%;
                margin-left: 0;
            }
        }
    
        @media (max-width: 480px) {
            body {
                font-size: 0.85rem;
            }
    
            h1, h2 {
                font-size: 1rem;
            }
    
            .btn {
                font-size: 0.8rem;
                padding: 0.3rem 0.6rem;
            }
        }
    
        img {
            max-width: 100%;
            height: auto;
        }
    
        .responsive-table {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }


    /* ✅ 2. Jangan sembunyikan sidenav sepenuhnya, biarkan toggle bekerja */
    @media (max-width: 768px) {
        /* Hapus aturan display:none agar tombol toggle bisa fungsional */
        .sidebar, #layoutSidenav_nav {
            display: block !important;
            position: fixed;
            z-index: 1030;
            width: 250px;
            height: 100%;
            background-color: #343a40;
            transition: transform 0.3s ease;
            transform: translateX(-100%);
        }

        body.sb-sidenav-toggled #layoutSidenav_nav {
            transform: translateX(0);
        }

        #layoutSidenav_content {
            margin-left: 0 !important;
            width: 100% !important;
        }
    }

    </style>
    

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
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/demo/datatables.js') }}"></script>
    
</body>
</html>
