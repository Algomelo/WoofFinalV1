<!DOCTYPE html>
<html lang="en">
<head> 
    <!-- Metadatos y enlaces CSS -->
    <meta charset="UTF-8">
    <meta name="autor" content="FabianRodriguez">
    <meta name="description" content="Web Oh My Woof">
    <meta name="keywords" content="pets">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oh My Woof!</title>
    <link rel="icon" type="image/x-icon" href="logos/ICONO-01.png">
 

    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/brands.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="fontawesome-fre-6.4.0-web/css/brands.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="css/stilos_navbar.css">
    <link rel="stylesheet" href="css/stilos_generales.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/titulos.css">

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-K72Z9HQ5');</script>
<!-- End Google Tag Manager -->
    
    

</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K72Z9HQ5"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    <!-- Barra de Navegación -->

    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container ">
            <a class="navbar-brand" href="{{ route('index')}}">
                <img class="img_style" src="/img/positive_logo.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" style="flex-grow:0">
                <ul class="navbar-nav ml-auto listanavbar text-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index')}}">Home</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gallery">Our Stars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus">About Us</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            Contact 
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="contactusers">Need Help</a></li>
                            <li><a class="dropdown-item" href="contactjob">Work with us</a></li>
                        </ul>
                    </li>

                    </ul>
                    <div class="container d-flex" style="justify-content:right; width:auto; padding:0; margin:0;">
                            <ul class="navbar-nav ml-auto listanavbar text-center">
                                <li class="nav-item">
                                    <a class="nav-link botonlogin" href="login">Log In</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="https://www.facebook.com/ohmywoofclub/"><i class="fab fa-facebook"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://wa.me/+61434560732"><i class="fab fa-whatsapp"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://www.instagram.com/ohmywoofau/"><i class="fab fa-instagram"></i></a>
                                </li>   
                            </ul> 
                    </div>               

            </div>
        </div>
    </nav>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fc42b657b4.js" crossorigin="anonymous"></script>
        <!-- jQuery, Popper.js, Bootstrap JS -->

    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>      
    <script src="https://unpkg.com/scrollreveal"></script>

<script>
    // Inicializar ScrollReveal
    ScrollReveal().reveal('.elemento', {
      delay: 300, // Retraso antes de mostrar el elemento
      distance: '20px', // Distancia desde la que se muestra el elemento
      origin: 'bottom', // Dirección desde la que aparece el elemento
      duration: 1000, // Duración de la animación
      easing: 'cubic-bezier(0.5, 0, 0, 1)', // Tipo de animación
      reset: true // Permitir que se revele en cada desplazamiento
    });
  </script>

</body>
</html>
