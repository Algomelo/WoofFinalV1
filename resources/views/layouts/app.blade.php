<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->


    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stilos_navbar.css') }}">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->

</head>
<body>
<div class="container encabezado">
    <header class="header_">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #015351;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="./index.php">
                        <img src="./img/logoazul.png" alt="Logo de la marca">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link"href="./index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./products">Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./gallery">OurStars</a>
                            </li>
							<li class="nav-item">
                                <a class="nav-link" href="./blog">Blogs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./about">About Us</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                    Contact 
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="./contactusers.php">Need Help</a></li>
                                    <li><a class="dropdown-item" href="./contactjob.php">Work with us</a></li>
     
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="btn" href="/login"><button class="btn btn-primary">Login</button></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    </div>
</body>
</html>
