@extends('layouts.panel')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                <h3 class="mb-0">Edit Request Service</h3>
                </div>
                <div class="col text-right">
                <a href="{{ url('serviceRequests')}}" class="btn boton"><i class="fas fa-angle-left"></i>Return</a>
                </div>
            </div>
        </div>
        <div class="card-body">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Please!!</strong> {{ $error }}
                    </div>
                @endforeach
            @endif
            

            <!-- Formulario de edición -->
            <form action="{{url('/serviceRequests/'.$serviceRequest->id)}}" method="POST">
                @csrf
                @method('PUT')

                <!-- Campos del formulario -->
               

                <div class="form-group">
                    <label for="unique_number">Unique Number:</label>
                    {{ $serviceRequest->unique_number }}
                </div>
                <div class="form-group">
                    <label for="name">User:</label>
                    {{ $serviceRequest->user->name}}
                </div>
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" id="comment" name="comment">{{ $serviceRequest->comment }}</textarea>
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <select name="state" class="form-control" placeholder= >
                        <option value="{{ $serviceRequest->state }}"> {{ $serviceRequest->state }} </option>
                        <option value="pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    
                </div>
                <div class="row">
                        <div class="col-lg-4 col-sm-12">
                            <label for="date">Estimated Date(s):</label> <br>
                            <input type="text" name="date" id="date"  ><br><br>
                            <span id="dateError" class="error"></span>

                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="shift">Shift:</label> <br>
                            <select name="shift" id="shift">
                                <option value="Any shift" {{ $serviceRequest->shift == 'Any shift' ? 'selected' : '' }}>Any shift</option>
                                <option value="morning" {{ $serviceRequest->shift == 'morning' ? 'selected' : '' }}>Morning Shift</option>
                                <option value="afternoon" {{ $serviceRequest->shift == 'afternoon' ? 'selected' : '' }}>Afternoon Shift</option>
                            </select>
                            <span id="shiftError" class="error"></span>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <label for="address">Address:</label> <br>
                            <input type="text" name="address" id="address"  value="{{$serviceRequest->address}}" >
                        </div>
                </div>

            <!-- Editar otros campos de la solicitud de servicio como comentario, estado, precio, etc. -->

            <!-- Added Services -->



            <div class="form-group">
    <h4>Added Services:</h4>
    <div class="container d-block">
        @foreach($serviceRequest->services as $service)
            <label for="service_{{ $service->id }}">
                <input type="checkbox" name="services[]" value="{{ $service->id }}" id="service_{{ $service->id }}" class="service-checkbox" checked>
                Service Name: {{ $service->name }}
            </label>
            <label for="service_{{ $service->id }}">
                Service Price: $ {{ $service->price }} (per Unit)
            </label>
            <input type="number" name="service_quantity[{{ $service->id }}]" placeholder="Quantity" value="{{ $service->pivot->service_quantity }}" class="quantity-input">
            <span class="service-price" style="display:none;">{{ $service->price }}</span>
        @endforeach
    </div>
</div>



                <div class="form-group">
                    <label for="custom_price">Enable Custom Price</label>
                    <input type="checkbox" name="custom_price" id="custom_price" onchange="toggleCustomPrice()">
                </div>
                <div id="total-price"><strong>Total Price: ${{$serviceRequest->price}} <br> </strong></div>



                <div class="form-group">
                    <label for="price">Custom Price</label>
                    <input type="number" name="price" class="form-control" value="" id="price-input" disabled>
                </div>


                <!-- Otros campos y controles según tus necesidades -->

                <!-- Botón de envío del formulario -->
                <button type="submit" class="btn boton">Save Changes</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
toggleCustomPrice()
showSection("includeServicesSection");

function showSection(sectionId) {
    // Oculta todas las secciones
    document.getElementById('includesSection').style.display = 'none';
    document.getElementById('includeServicesSection').style.display = 'none';

    // Muestra la sección correspondiente al ID recibido como parámetro
    document.getElementById(sectionId).style.display = 'block';

    // Declara e inicializa las variables antes de acceder a sus propiedades
    var textoPaquete = document.getElementsByClassName('texto_paquete')[0];
    var textoServicio = document.getElementsByClassName('texto_servicio')[0];

    // Cambia el color del texto y del fondo para reflejar la sección activa
    if (sectionId == "includesSection") {
        textoPaquete.style.color = '#fff';
        textoPaquete.style.backgroundColor = "#F2761D";
        textoServicio.style.backgroundColor = "#fff";
        textoServicio.style.color = 'black'; // Cambia el color del otro enlace
    } else if (sectionId == "includeServicesSection") {
        textoServicio.style.color = 'white';
        textoServicio.style.backgroundColor = "#F2761D";
        textoPaquete.style.backgroundColor = "#fff";
        textoPaquete.style.color = 'black'; // Cambia el color del otro enlace
    }
}
</script>



<script>
    $(document).ready(function () {
        $('input[type="checkbox"][name^="packages"]').change(function () {
            var packageId = $(this).attr('id').split('_')[1];
            var quantityInput = $('input[name="package_quantity[' + packageId + ']"]');

            if ($(this).prop('checked')) {
                quantityInput.val(1);
                updateTotalPrice()
            } else {
                quantityInput.val('');
            }
        });
    });

const serviceCheckboxes = document.querySelectorAll('.service-checkbox');
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const servicePrices = document.querySelectorAll('.service-price');
    const totalPriceElement = document.getElementById('total-price');
    const priceInput = document.getElementById('price-input');
    const enableCustomPriceCheckbox = document.getElementById('custom_price');

    function toggleCustomPrice() {
        // Habilitar o deshabilitar el campo "Custom Price" según el estado del checkbox
        priceInput.disabled = !enableCustomPriceCheckbox.checked;

        // Limpiar los event listeners para evitar la duplicación
        serviceCheckboxes.forEach((checkbox, index) => {
            checkbox.removeEventListener('change', updateTotalPrice);
            quantityInputs[index].removeEventListener('input', updateTotalPrice);
        });

        // Añadir event listeners dependiendo del estado del checkbox
        if (!enableCustomPriceCheckbox.checked) {
            serviceCheckboxes.forEach((checkbox, index) => {
                checkbox.addEventListener('change', updateTotalPrice);
                quantityInputs[index].addEventListener('input', updateTotalPrice);
            });
        } else {
            priceInput.addEventListener('input', updateTotalPrice);
        }
    }

    serviceCheckboxes.forEach((checkbox, index) => {
        checkbox.addEventListener('change', updateTotalPrice);
        quantityInputs[index].addEventListener('input', updateTotalPrice);
    });

    priceInput.addEventListener('input', updateTotalPrice);

    function updateTotalPrice() {
        let totalPrice = 0;

        // Verifica si price-input tiene un valor válido.
        const enteredPrice = parseFloat(priceInput.value);
        if (!isNaN(enteredPrice)) {
            totalPrice = enteredPrice; // Utiliza el valor ingresado en price-input.
        } else {
            priceInput.value = null;  // o puedes asignar null: priceInput.value = null;

            // Suma los precios de los servicios multiplicados por sus cantidades si no se ingresó un valor en price-input.
            serviceCheckboxes.forEach((checkbox, index) => {
                if (checkbox.checked) {
                    const quantity = parseInt(quantityInputs[index].value, 10);
                    if (!isNaN(quantity)) {
                        totalPrice += parseFloat(servicePrices[index].textContent) * quantity;
                    }
                }
            });
        }

        totalPriceElement.style.display = 'block';
        totalPriceElement.innerHTML = `<strong>Total Price: $${totalPrice.toFixed(2)}</strong>`;
    }

</script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Agrega esto en tu plantilla Blade después de incluir jQuery -->
<script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtén el elemento de cantidad
            var dateInput = document.getElementById('date');
            
            // Obtén las fechas preseleccionadas desde tu controlador de Laravel
            var preselectedDates = {!! json_encode($scheduledDates) !!};
            
            var fp = flatpickr(dateInput, {
                mode: 'multiple',
                dateFormat: 'Y-m-d',
                defaultDate: preselectedDates,  // Establece las fechas preseleccionadas
                onChange: function () {
                    // Actualiza la cantidad basada en la selección de fechas
                    updateQuantity();
                    // Valida si la cantidad de fechas seleccionadas es mayor que la cantidad disponible
                    validateDateQuantity();
                }
            });
        });
     
</script>
@endsection