<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oh My Woof Landing Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/landing_style.css">
    <link rel="stylesheet" href="css/landing_style.css">
    <link rel="stylesheet" href="css/flaticon1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>


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
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img class="img_style" src="./img/positive_logo.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="#testimonials">Testimonials</a>
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
</nav>


<!-- Banner -->
<div id="banner" >
    <video autoplay muted loop playsinline poster="./img/bg_1.jpg" id="video-bg">
        <source src="./img/videobanner.mp4" type="video/mp4">
        Tu navegador no admite el elemento de video.
    </video>
    <div class="banner-content">
        <h1>Welcome to Oh My Woof !</h1>
        <p>Your furry friend's best care is our priority</p>
        <a href="#services-contact" class="scroll-down-btn">
        <i class="fas fa-chevron-down"></i>
        </a>
        
    </div>
</div>


<!-- Services and Contact Section -->
<section id="services-contact" class="container-fluid">
    <div class="row">
        
        <div class="col-lg-5">
        <div class="contact-form-container">
    <h2 class="titulo-contenedor">Contact Us</h2>
    
        <form action="{{ secure_url('confirm-landing') }}" method="POST" id="LandingForm" name="LandingForm">
            @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name"placeholder="Your Name" required>
            </div>
            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">   

            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Your Phone" required>
            </div>
            <div class="form-group col-md-6">
                <label for="service">Interested Service</label>
                <select class="form-control" id="service" name="service" required>
                    <option value="" selected disabled>Select a service...</option>
                    <option value="Dog Walking">Dog Walking</option>
                    <option value="Dog Parties">Dog Parties</option>
                    <option value="Dog Boarding">Dog Boarding</option>
                    <option value="Dog Day Care">Doggy Day Care</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Your address" required>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Dog Age</label>
                <input type="text" class="form-control" id="dogage" name="dogage" placeholder="Age of your dog">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Dog Name</label>
                <input type="text" class="form-control" id="namedog" name="namedog" placeholder="Name of your dog">
            </div>
            <div class="form-group col-md-6">
                <label for="email">Breed of Dog</label>
                <input type="text" class="form-control" id="breeddog" name="dogbreed" placeholder="Breed of your Dog">
            </div>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="3" placeholder="Your Message"></textarea>
        </div>
        <button class="btn btn-primary py-3 px-7" type="submit" id="sendMessageButton" style="background: #015351; border-radius:30px; color:white;">Send Message</button>
    </form>
</div>
            
        </div>
        <div class="col-lg-7">
            <h2 class="titulo-contenedor">Why Choose Us?</h2>
   
    				<div class="row">
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="fa-solid fa-shield-dog"></span></div>
                    
                            <div class="text pl-3">
	    						<h4>Professional Services</h4>
	    						<p>Dog walking and daytime care tailored to your pet's needs</p>
	    					</div>
	    				</div>
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="fa-solid fa-paw"></span></div>
	    					<div class="text pl-3">
	    						<h4>Experienced Team</h4>
	    						<p>We have compassionate staff who love dogs as much as you do. </p>
	    					</div>
	    				</div>
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="fa-solid fa-shield-dog"></span></div>
	    					<div class="text pl-3">
	    						<h4>Flexible Scheduling</h4>
	    						<p>Convenient scheduling option to fit your busy  lifestyle</p>
	    					</div>
	    				</div>
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="fa-solid fa-paw"></span></div>
	    					<div class="text pl-3">
	    						<h4>Guaranteed Safety</h4>
	    						<p>Secure environment for your furry friend to socialize and  play regular updates and photos to keep you  connected with your pet's activities</p>
	    					</div>
	    				</div>
	    			</div>
                    <div class="social-icons">
                       <a href="https://wa.me/+61434560732"><i class="fab fa-whatsapp" style="color:green"></i></a>
                       <a href="https://www.facebook.com/ohmywoofclub/"><i class="fab fa-facebook"></i></a>
                       <a href="https://www.instagram.com/ohmywoofau/"><i class="fab fa-instagram" style="color:white"></i></a>
                      
                    </div>
                    <div class="container" style="text-align:center; color:white;">
                    <hr><h3><i class="fa-solid fa-location-dot"></i> 3, Fripp Street, Arncliffe, NSW 2205</h3><hr>

                    </div>                        
        </div>
    </div>
    <!-- Rest of the code remains unchanged -->
</section>
 <!-- servicios -->
<section id="our-services" class="container">
    <h2 class="titulo-contenedor">Our Services</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
            
                <img src="./imagess/day1.jpg" class="card-img-top" alt="Service 3">
                <div class="card-body">
                    <h5 class="card-title">Dog Day Care</h5>
                    <p class="card-text">Elevate your dog's day at our spacious Dog Day Care. Enjoy playtime with new friends, pick-up and drop-off services available.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <img src="./img/DOG_WALKING/IMG_7240.jpg" class="card-img-top" alt="Service 2">
                <div class="card-body">
                    <h5 class="card-title">Dog Trip</h5>
                    <p class="card-text">Join Dog Trips for 2-4 hour adventures that provide unique socialization and exercise opportunities for your dog. Start today!</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <img src="./img/DOG_BOARDING/IMG_5149.jpg" class="card-img-top" alt="Service 1">
                <div class="card-body">
                    <h5 class="card-title">Dog Boarding</h5>
                    <p class="card-text">Trust us for top-notch Dog Boarding when you can't be there. Your furry friend will have a comfortable stay with our specialists.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <img src="./img/DOG_PARTIES/dogparty.png" class="card-img-top" alt="Service 4">
                <div class="card-body">
                    <h5 class="card-title">Dog Parties</h5>
                    <p class="card-text">Unleash fun at Dog Parties! Join us for 2-4 hour adventures where your dog bonds with furry friends, contributing to their growth.</p>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Testimonials Section -->
<section id="testimonials" class="container-fluid" >
    <h2 class="titulo-contenedor" style="color:black">What Our Clients Say</h2>
    <div class="row testimonios">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                <div class="text-center">
                        <img src="./img/testimonio1.jpg" alt="Mike Johnson" class="testimonial-img">
                </div>
                <p class="card-text"><strong>Pennie Culpan</strong></p>
                <p class="card-text">"I have been using Oh My Woof for daily walks and occasional full day care for a few weeks now and can highly recommend Juan and his team to care for your furbaby. Bonny is always super excited to see them and always comes back pooped, happy and relaxed. I have now booked her in for boarding and feel relaxed that she will have a good time and be safe in Juan's care."</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                <div class="text-center">
                        <img src="./img/testimonio2.jpg" alt="Mike Johnson" class="testimonial-img">
                </div>
                <p class="card-text"><strong>Kelli Martin</strong></p>
                <p class="card-text">"Oh My Woof are simply amazing! From the moment my little Loki met Juan it was clear to see how much love he has for dogs and it is clearly reciprocated. Loki runs to the door with excitement when he gets picked up for his walkies and I couldn’t think of a better company to leave my dog with! Highly recommended 🐶"</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                <div class="text-center">
                        <img src="./img/testimonio3.jpg" alt="Mike Johnson" class="testimonial-img">
                </div>
                <p class="card-text"><strong>Mike Johnson</strong></p>
                <p class="card-text">"Lovely friendly service and extremely excited dog! He comes home so and then tired ❤👌 Thank you 🙏🏻"</p>
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    &copy; 2023 Your Pet Care. All rights reserved.
</footer>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom JavaScript -->
<script>
    
    // Función para manejar el clic en el botón de desplazamiento
    function scrollToSection(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        const target = document.querySelector(event.currentTarget.getAttribute('href'));
        if (target) {
            window.scrollTo({
                top: target.offsetTop,
                behavior: 'smooth' // Agrega un desplazamiento suave
            });
        }
    }

    // Asigna el evento de clic al botón
    const scrollButtons = document.querySelectorAll('.scroll-down-btn');
    scrollButtons.forEach(button => {
        button.addEventListener('click', scrollToSection);
    });
    </script>
   <script>
    $('#LandingForm').submit(function (event) {
        event.preventDefault();
        // Deshabilita el botón y muestra un mensaje de espera
        Swal.fire({
            title: 'Processing...',
            text: 'Please wait a moment while we process your request.',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                $('#sendMessageButton').prop('disabled', true);
            }
        });

        grecaptcha.ready(function () {
            grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', { action: 'submit' }).then(function (token) {
                document.getElementById("g-recaptcha-response").value = token;
                // Envía el formulario a través de AJAX
                $.ajax({
                    type: 'POST',
                    url: $(event.target).attr('action'),
                    data: $(event.target).serialize(),
                    success: function (response) {
                        // Restaura el botón y cierra el mensaje de espera
                        $('#sendMessageButton').prop('disabled', false);
                        Swal.close();

                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonText: 'Closed',
                            });
                        } else if (response.status === 'error') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Fail!',
                                text: response.message,
                                confirmButtonText: 'Closed',
                            });
                        }
                    },
                    error: function () {
                        // Restaura el botón y cierra el mensaje de espera
                        $('#sendMessageButton').prop('disabled', false);
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Fail!',
                            text: 'There was an issue submitting the request. Please try again later.',
                            confirmButtonText: 'Closed',
                        });
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'store-email-contact-landing',
                    data: formData,
                    success: function (response) {
                     // Manejo de la respuesta exitosa para la segunda ruta
                    console.log('Response from second route:', response);
                    // Puedes agregar aquí cualquier código adicional que necesites después de la segunda solicitud
                    },
                    error: function (error) {
                    // Manejo de errores para la segunda ruta                    
                    console.error('Error in second route:', error);
                    }
                    });
            });
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


</body>
</html>
