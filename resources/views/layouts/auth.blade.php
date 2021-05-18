<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GestionaH - Login</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="main-login">

        <div id="login-content">
            <img src="{{asset('images/invoice.png')}}" alt="Invoice Image" srcset="">
            <h5 class="text-muted">Manage Your Company with us !</h5>
        </div>

        <div id="login-body">
            <div class="d-flex justify-content-center mb-3">
                <img class="logo" src="{{asset('images/gestionah.png')}}" alt="">
            </div>

            <div>
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>

