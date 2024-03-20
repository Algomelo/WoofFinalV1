@include('layouts.header')
<head>
    <link rel="stylesheet" href="css/style_contactjob.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
</head>

<main  style="background-image: url('/imagess/banner_huellas.png');">
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <legend class="text-center header"><h2 class="text-center">Join Our Team and Make a Difference in the Lives of Dogs!</h2></legend>
            <p class="text-center">Are you passionate about dogs? Do you want to work in a fun and rewarding environment? Look no further!</p>
            <p class="text-center">At our doggy daycare, we are dedicated to providing the best care and love for our furry friends. We are looking for enthusiastic individuals who share our love for dogs and are committed to their well-being.</p>
            <p class="text-center">As a part of our team, you'll have the opportunity to:</p>
            <ul class="text-center">
                <p>* Interact and play with adorable dogs all day long</p>
                <p>* Ensure the safety and happiness of our furry guests</p>
                <p>* Be part of a supportive and passionate team</p>
                <p>* Gain valuable experience in the pet care industry</p>
                <p>* Create lasting memories and forge meaningful connections</p>
            </ul>
            <p class="text-center">If you are reliable, energetic, and have a genuine love for dogs, we would love to hear from you!</p>
            <p class="text-center">To apply, simply fill out the form below and tell us why you would be a great fit for our team. Join us in providing a loving and nurturing environment for our four-legged companions.</p>
        </div>
    </div>
</div>
    <div class="container-fluid" style="background-image: url(/img/banner_huellas_azul.png);">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="well well-sm">
                    <form action="{{ secure_url('/confirm-contacjob')}}"  method="POST" name="contactFormJob" id="contactFormJob" class="form-horizontal" >
                        @csrf
                        <fieldset>
                            <legend class="text-center header">Work with us !</legend>
                            <div class="form-group row">
                                <label for="fname" class="col-md-2 col-form-label text-center"><i class="fa fa-user bigicon"></i></label>
                                <div class="col-md-8">
                                    <input id="name" name="name" type="text" placeholder="Full Name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lname" class="col-md-2 col-form-label text-center"><i class="fa fa-user bigicon"></i></label>
                                <div class="col-md-8">
                                    <input id="address" name="address" type="text" placeholder="Address" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-center"><i class="fa fa-envelope-o bigicon"></i></label>
                                <div class="col-md-8">
                                    <input id="email" name="email" type="email" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-md-2 col-form-label text-center"><i class="fa fa-phone-square bigicon"></i></label>
                                <div class="col-md-8">
                                    <input id="phone" name="phone" type="number" placeholder="Phone" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="message" class="col-md-2 col-form-label text-center"><i class="fa fa-pencil-square-o bigicon"></i></label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="message" name="message" placeholder="Enter your message for us here. We will get back to you within 2 business days." rows="7"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">   
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                <button class="btn btn-primary py-3 px-7" type="submit" id="sendMessageButton" style="background: #015351; border-radius:30px; color:white;">Send Message</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $('#contactFormJob').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();

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
                                // segunda solicitud AJAX
                $.ajax({
                    type: 'POST',
                    url: 'store-email-contact-job',
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
@include('layouts.footer')