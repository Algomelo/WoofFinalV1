@include('layouts.header')
<head>
    <link rel="stylesheet" href="css/style_contactusers.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
</head>
<main>
<section class="ftco-section ftco-no-pt ftco-no-pb" style="  background-image: url('/img/banner_huellas.png');     padding-bottom: 0 !important; ">
    	<div class="container">
    		<div class="row d-flex no-gutters">
    			<div class="col-md-5 d-flex">
                        <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0 " style="background-image:url({{ asset('images/about-1.png') }});">
                        </div>
                        <div id="lottie-container"></div>
    			</div>
    			<div class="col-md-7 pl-md-5 py-md-5">
                    <div class="row justify-content-center">
                    <div class="col-12 col-sm-8 mb-5">
                <div class="contact-form">
                    <div id="success">
                        <h2 class="text-center" style="margin-bottom:20px;"> Leave your information, we will contact you immediately </h2>
                    </div>
                    <form action="{{ secure_url('confirm-contactt')}}" method="POST" name="contactForm" id="contactForm">
                        @csrf
                        <div class="control-group">

                            <input type="text" class="form-control p-4" id="name" name="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control p-4" id="email" name="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control p-4" id="phone" name="phone" placeholder="Phone" required="required" data-validation-required-message="Please enter a subject">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control p-4" rows="6" id="message" name="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="d-flex justify-content-center">
                        <button class="btn btn-primary py-3 px-7" type="submit"  style="background: #015351; border-radius:30px; color:white;">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
	          
    			</div>
    		</div>
    	</div>
    
        <div class="col-12">
        <iframe style="width: 100%; height: 300px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d123767!2d151.2092966!3d-33.8688197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12ae0a6f67239d%3A0x3017a5228f172994!2sSydney%20NSW%2C%20Australia!5e0!3m2!1sen!2sus!4v1603794290143!5m2!1sen!2sus" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </section>
    <script>
$('#contactForm').submit(function (event) {
    event.preventDefault();

    // Datos del formulario serializados
    var formData = $(this).serialize();

    // Primera solicitud AJAX a la primera ruta
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'), // URL del formulario
        data: formData,
        success: function (response) {
            // Manejo de la respuesta exitosa para la primera ruta
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: response.message,
                confirmButtonText: 'Closed',
            });        
            console.log('Response from first route:', response);

            // Puedes agregar aquí cualquier código adicional que necesites después de la primera solicitud
        },
        error: function (error) {
            // Manejo de errores para la primera ruta
             Swal.fire({
                icon: 'error',
                title: 'Fail!',
                text: response.message,
                confirmButtonText: 'Closed',
            });            
            console.error('Error in first route:', error);
        }
    });

    // Segunda solicitud AJAX a la segunda ruta
    $.ajax({
        type: 'POST',
        url: 'store.email.contact', // Reemplaza 'URL_DE_LA_SEGUNDA_RUTA' con la URL real de la segunda ruta
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

    // También puedes mostrar un mensaje de éxito aquí o realizar otras acciones necesarias
});

        </script>
</main>
@include('layouts.footer')