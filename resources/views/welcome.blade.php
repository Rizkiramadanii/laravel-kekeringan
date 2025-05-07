<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediksi kekeringan - BMKG Bengkulu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            background: url('{{ asset('assets/img/bg-bmkg.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.5); /* gelap transparan */
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .address {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .login-btn {
            margin-top: 30px;
            font-size: 1.2rem;
            padding: 15px 40px;
        }
    </style>
</head>
<body>
    <div class="overlay">
        <h1>Prediksi kekeringan - BMKG Bengkulu</h1>
        <div class="address">
            Stasiun Klimatologi BMKG Bengkulu<br>
            Jl. Ir. Rustandi Sugianto, Pulau Baai, Kampung Melayu, Kandang Mas, Kec. Kp. Melayu, Kota Bengkulu, Bengkulu 38216, Indonesia
        </div>
        <a href="{{ route('login') }}" class="btn btn-primary login-btn">LOGIN</a>
    </div>
</body>
</html>