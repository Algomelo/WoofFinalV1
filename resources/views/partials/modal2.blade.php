<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal with Lottie Animation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados para la ventana modal */
        .custom-modal .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }

        .custom-modal .modal-header {
            background-color: #ffc107;
            border: none;
            border-radius: 15px 15px 0 0;
        }

        .custom-modal .modal-title {
            color: white;
        }

        .custom-modal .modal-body {
            padding: 30px;
        }

        .custom-modal .btn-primary {
            background-color: #ff9800;
            border: none;
            transition: background-color 0.7s;
            

        }

        .custom-modal .btn-primary:hover {
            background-color: #f57c00;
        }
        .modal-buttons {
            text-align: center;
            margin-top: 30px;
        }

        .button {
    background-color: #ff6600; /* Color naranja */
    color: #fff; /* Color de texto blanco */
    border: none; /* Sin borde */
    border-radius: 50px; /* Radio del borde del 50% para hacerlo circular */
    padding: 15px 30px; /* Ajusta el relleno según tu preferencia */
    font-size: 16px; /* Tamaño del texto */
    cursor: pointer; /* Cambia el cursor al pasar por encima */
    transition: background-color 0.3s, transform 0.3s; /* Transición suave al cambiar el color de fondo y aplicar transformaciones */
}

/* Estilo al pasar el cursor por encima (hover) */
.button:hover {
    background-color: #ff8800; /* Cambia el color naranja al pasar el cursor */
    transform: scale(1.05); /* Hace que el botón aumente ligeramente de tamaño */
}

/* Estilo para la animación al hacer clic */
.button:active {
    transform: scale(0.95); /* Hace que el botón se reduzca ligeramente al hacer clic */
}

    </style>
</head>
<body>

    <!-- Ventana Modal -->
    <div class="modal fade custom-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              
                <div class="modal-header">
                    <h4 class="modal-title">Select Option</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-buttons">
                    <button class="button" id="contactarBtn">Deseo contactar un asesor</button>
                    <button class="button" id="ingresarBtn">Ingresar</button>
                </div>
                <div class="modal-body">
                    <div id="formContent" style="display: none;" class="row">
                    <form action="{{ secure_url('confirm-appointment') }}" method="POST" id="appointmentForm">
                        @csrf
                        <input type="hidden" id="service" name="service" value="">
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="serviceName">Service:</label>
                            <input type="text" class="form-control" id="serviceName" name="serviceName" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone">Phone:</label>
                            <input type="tel" class="form-control"  id="phone" name="phone"placeholder="Phone" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dogbreed">Dog Breed:</label>
                            <input type="text" class="form-control" id="dogbreed" name="dogbreed" placeholder="Dog Breed" required>
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" rows="4" id="message" name="message" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="button">Submit</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>

+

 
  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.10/lottie.min.js"></script>
    <script>
    var contactarBtn = document.getElementById("contactarBtn");
    var ingresarBtn = document.getElementById("ingresarBtn");
    var formContent = document.getElementById("formContent");


         // Mostrar el contenido del formulario al hacer clic en "Deseo contactar un asesor"
    contactarBtn.addEventListener("click", function () {
        formContent.style.display = "block";
    });

    // Redirigir a la página de inicio de sesión al hacer clic en "Ingresar"
    ingresarBtn.addEventListener("click", function () {
        // Cambia la URL de redirección según tu configuración
        window.location.href = "login";
    });

    

       

    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var service = button.data('service');
        $('#service').val(service);
        $('#serviceName').val(service);
    });

    $('#appointmentForm').submit(function (event) {
        event.preventDefault();

        $.ajax({
            type: 'POST', // Especifica el método como POST
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function () {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'La solicitud se ha enviado correctamente.',
                    confirmButtonText: 'Cerrar',
                });

                $('#myModal').modal('hide');
            },
            error: function () {
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
</body>
</html>


