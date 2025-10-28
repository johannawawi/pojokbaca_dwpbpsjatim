<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('/img/logo-dwp.png')}}" rel="icon">
    <title>Pojok Baca DWP BPS Jatim</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('/template/css/ruang-admin.min.css')}}" rel="stylesheet">
    <link href="{{asset('/template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/template/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom style for blur + zoom effect -->
    <style>
        .blur-login {
            background-color: rgba(255, 255, 255, 0.4); /* Blur ringan */
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            border-radius: 15px;
            padding: 30px;
            transition: all 0.3s ease;
            transform: scale(1);
        }

        .blur-login:hover {
            background-color: rgba(255, 255, 255, 0.9); /* Lebih terang saat hover */
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
        }
    </style>
</head>

<body style="background-image: url('{{ asset('img/bg-perpus.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center; min-height: 100vh; font-family: 'Nunito', sans-serif;">

<div class="header" style="background-color: rgba(0, 0, 0, 0.5); padding: 50px 0; color: #fff; text-align: center;">
    <!--Content before waves-->

        @yield('content') <!-- Login form masuk dari sini -->
   <!--Waves Container-->

    <!--Waves end-->
</div>
<!--Header ends-->

</body>
</html>
