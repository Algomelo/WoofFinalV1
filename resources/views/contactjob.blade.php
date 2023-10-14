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
                    <form action="{{ secure_url('/confirm-contacjob')}}" name="contactFormJob" id="contactFormJob" class="form-horizontal" method="POST">
                        @csrf
                        <fieldset>
                            <legend class="text-center header">Work with us !</legend>

                            <div class="form-group row">
                                <label for="fname" class="col-md-2 col-form-label text-center"><i class="fa fa-user bigicon"></i></label>
                                <div class="col-md-8">
                                    <input id="fullname" name="fullname" type="text" placeholder="Full Name" class="form-control">
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

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn">Submit</button>
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
    
        $.ajax({
            type: 'POST', // Método POST
            url: $(this).attr('action'), // URL del formulario
            data: $(this).serialize(), // Datos del formulario serializados
            success: function (response) {
                // Manejo de la respuesta exitosa, puedes actualizar la vista o mostrar un mensaje de éxito
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'La solicitud se ha enviado correctamente.',
                    confirmButtonText: 'Cerrar',
                });
            },
            error: function (error) {
                // Manejo de errores, puedes mostrar un mensaje de error
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Hubo un problema al enviar la solicitud. Por favor, inténtalo de nuevo más tarde.',
                    confirmButtonText: 'Cerrar',
                });
            }
        });
    });
    
            </script>

@include('layouts.footer')